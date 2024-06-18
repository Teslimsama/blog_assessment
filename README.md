
# Blog Assessment

This is the phase one assessment of my skill as a Mid-Level laravel/php developer


## Acknowledgements

 - [Laravel](https://laravel.com)
 - [Tailwind Css](https://tailwindcss.com)


## Deployment

To deploy this project run

```bash
  composer install
```
```bash
  composer update
```

```bash
  npm install
```
```bash
  npm run dev
```

## installation 
```bash
  php artisan serve
```
```bash
  php artisan migrate 
```

```bash
php artisan db:seed
```
# API Reference 
## Blog Application API

#### Create New Blog

```http
 POST /api/v1/blog
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |

#### Show Blog

```http
  GET /api/v1/blog/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of blog  |


#### Delete Blog

```http
  DELETE /api/v1/blog/${id}

```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of blog  |
| `title`      | `string` | **Required**. Title of blog |


#### List All Blogs

```http
    GET /api/v1/blog

```

#### Update Blog

```http
      PATCH /api/v1/blog/${id}

```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of blog to fetch |


## Comments API

#### Create Comment

```http
  POST /api/v1/blog/${blog_id}/comment

```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `body` | `string` | **Required**. Body of the comment |

#### List all blog comments

```http
    GET /api/v1/blog/${blog_id}/comment
```

#### Delete Comment
```http
      DELETE /api/v1/blog/${blog_id}/comment/${comment_id}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `blog_id` | `string` | **Required**. Blog ID |
| `comment_id` | `string` | **Required**. Comment ID |

#### Show Comment
```http
       GET /api/v1/blog/${blog_id}/comment/${comment_id}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `blog_id` | `string` | **Required**. Blog ID |
| `comment_id` | `string` | **Required**. Comment ID |

#### Update Comment
```http
         PATCH /api/v1/blog/${blog_id}/comment/${comment_id}

```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `blog_id` | `string` | **Required**. Blog ID |
| `comment_id` | `string` | **Required**. Comment ID |
| `body` | `string` | **Required**. Updated comment body|
 
 ## User Authentication API

#### Login Request

```http
   POST /api/v1/login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required**. User's email |
| `password` | `string` | **Required**. User's password |

#### Register User

```http
     POST /api/v1/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. User's name |
| `email` | `string` | **Required**. User's email |
| `password` | `string` | **Required**. User's password |
