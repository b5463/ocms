## jwt setup

1. require jwt package with: `composer require tymon/jwt-auth`
2. Install RainLab\User plugin
3. In Routes that will need loggged user use middleware `auth`
4. In these routes you must use model `LibUser\Userapi\Models\User`, because there is implemented jwt
5. Add this line to .htaccess file on second line
```RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]```

6. If you used middleware and added Authorization header with jwt, you can access logged user with: `auth()->user()`
