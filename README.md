# Zao Bao Clone

This repository recreates a simplified version of Zao Bao using Statamic, which is based on Laravel. Statamic prefers flat repositories and as such this project can be cloned and the articles will be populated.

### Reasoning

The project is created using Statamic, a dynamic CMS based on Laravel. The task requires me to use PHP without specifying how the SPH team expects the project to be approached. There is no use reinventing the wheel when the team behind Statamic has done all the ground work. While I contemplated building a tiny CMS in raw PHP, I ultimately decided against it. The powerful CMS allowed me to build the project only focusing on design and the custom modifier that calculates reading time.

The styling of the page relies on Tailwind, which is similar to Bootstrap utility classes, for rapid prototyping.

### Reading Time

While statamic does come with a [read_time](https://statamic.dev/modifiers/read_time) modifier, it works using words per minute and does not consider for Chinese. The following is one of the only few PHP code written for the project.

```php
// app/Modifiers/CustomReadTime.php
public function index($value, $params, $context)
{
    // if params are passed, use them as the words per minute
    if (count($params)) $wordsPerMinute = $params[0];
    else $wordsPerMinute = 200;

    $words = strlen(strip_tags($value));
    $time = $words / $wordsPerMinute;

    if ($time < 1) return '少于1分钟'; // if it is less than a minute, return "少于1分钟"
    return round($time) . '分钟'; // else return round($time) . '分钟';
}
```

### How to test

This assumes you have already installed PHP, Composer and Node.

```bash
# Install PHP Dependencies
composer i

# Start the server
php artisan serve
```

## Examples

The reading time might be slightly off as I have since ammended the code to round up instead of just taking the ceiling. This makes the reading time satisfy the example on the documentation

## Web View

### Main Page

![image](https://user-images.githubusercontent.com/38975808/236646354-38020337-5633-4fcd-8975-f2acae231c00.png)

### Article Page

https://user-images.githubusercontent.com/38975808/236647493-f5168074-4c90-461a-9707-528ae33ac711.mov

## Mobile View

### Main Page

<img width="428" alt="image" src="https://user-images.githubusercontent.com/38975808/236647865-9b16000f-c573-46aa-9b86-34271f0847ca.png">

### Article Page

<img width="428" alt="image" src="https://user-images.githubusercontent.com/38975808/236647858-82354b8b-4752-46e4-8843-38f037d9f018.png">
