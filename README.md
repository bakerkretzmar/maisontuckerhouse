#### Setup

Site root must be `<project-dir>/web`.

Make sure the Nginx config includes the following **before** the main `location ~ \.php$` block:

```nginx
# Bedrock/Sage
# Prevent PHP scripts from being executed inside the uploads folder
location ~* /app/uploads/.*\.php$ {
    deny all;
}
# Prevent public access to Blade templates
location ~* \.blade\.php$ {
    deny all;
}
```

See:

- https://docs.roots.io/bedrock
- https://docs.roots.io/bedrock/master/server-configuration/#nginx-configuration-for-bedrock
