<?php
function validateFilePath($path)
{
    if (!preg_match('/\.(jpg|png)$/i', $path) || !file_exists($path)) {
        return false;
    }

    return $path;
}
function validatePostsJson($jsonData)
{
    $errors = [];

    foreach ($jsonData as $index => $item) {
        $filters = [
            'id' => FILTER_VALIDATE_INT,
            'likes' => FILTER_VALIDATE_INT,
            'timestamp' => [
                'filter' => FILTER_CALLBACK,
                'options' => function ($value) {
                    return ($value > 0) ? $value : false;
                }
            ],
        ];

        $authorFilters = [
            'user_id' => FILTER_VALIDATE_INT,
            'user_name' => [
                'filter' => FILTER_CALLBACK,
                'options' => function ($value) {
                    return (strlen($value) > 0 && strlen($value) <= 100) ? $value : false;
                }
            ],
            'logo_path' => [
                'filter' => FILTER_CALLBACK,
                'options' => 'validateFilePath'
            ]
        ];

        $imageFilters = [
            'path' => [
                'filter' => FILTER_CALLBACK,
                'options' => 'validateFilePath'
            ]
        ];

        $validatedItem = filter_var_array($item, $filters);
        $validatedAuthor = filter_var_array($item['author'], $authorFilters);
        $validatedImages = [];
        foreach ($item['images'] as $imgIndex => $image) {
            $validatedImage = filter_var_array($image, $imageFilters);
            if (isset($validatedImage['path']) === false) {
                $errors[] = "Ошибка в элементе $index: поле 'images[$imgIndex].path' не прошло валидацию.";
            }
            $validatedImages[] = $validatedImage;
        }

        foreach ($validatedItem as $key => $value) {
            if (isset($value) === false) {
                $errors[] = "Ошибка в элементе $index: поле '$key' не прошло валидацию.";
            }
        }

        foreach ($validatedAuthor as $key => $value) {
            if (isset($value) === false) {
                $errors[] = "Ошибка в элементе $index: поле 'author.$key' не прошло валидацию.";
            }
        }

    }

    return $errors;
}

function validateUserJson($jsonData)
{
    $errors = [];

    foreach ($jsonData as $userKey => $user) {
        $userFilters = [
            'id' => FILTER_VALIDATE_INT,
            'user_name' => [
                'filter' => FILTER_CALLBACK,
                'options' => function ($value) {
                    return (strlen($value) > 0 && strlen($value) <= 100) ? $value : false;
                }
            ],
            'logo_path' => [
                'filter' => FILTER_CALLBACK,
                'options' => 'validateFilePath'
            ],
            'description' => [
                'filter' => FILTER_CALLBACK,
                'options' => function ($value) {
                    return (strlen($value) <= 500) ? $value : false;
                }
            ]
        ];

        $postFilter = [
            'path' => [
                'filter' => FILTER_CALLBACK,
                'options' => 'validateFilePath'
            ]
        ];

        $validatedUser = filter_var_array($user, $userFilters);
        $validatedPosts = [];
        foreach ($user['posts'] as $postIndex => $post) {
            $validatedPost = filter_var_array($post, $postFilter);
            if (isset($validatedPost['path']) === false) {
                $errors[] = "Ошибка в элементе $userKey: поле 'images[$postIndex].path' не прошло валидацию.";
            }
            $validatedPosts[] = $validatedPost;
        }
        
        foreach ($validatedUser as $key => $value) {
            if (isset($value) === false) {
                $errors[] = "Ошибка у пользователя $userKey: поле '$key' не прошло валидацию.";
            }
        }
    }

    return $errors;
}
?>