1. run `composer install`
2. run `php index.php recursive target_folder result_folder file_extensions`

- target_folder - директория, с которой необходимо снять копию (по умолчанию ищет *struct* из корня проекта)
- result_folder - директория, куда необходимо скопировать реузльтуирующее дерево (по умолчанию создает *result* в корне проекта)
- file_extensions - расширения файлов, которые необходимо перенести в результирующую структуру (по умолчанию `php,js,html`)

# example
`php index.php recursive /var/www/project/ /home/user/copy_project/ php,js,twig`