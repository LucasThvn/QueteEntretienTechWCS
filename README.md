# Getting Started with my project

```git clone https://github.com/LucasThvn/QueteEntretienTewhWCS.git [folder name]```

Clone .env file, rename it .env.local and write your infos at line 32 (DATABASE_URL)

Run ```composer install```

Run ```yarn install```

Run ```php bin/console doctrine:database:create```

Run ```php bin/console d:s:u --force```

In a tab run ```symfony server:start```, in another tab run ```yarn encore dev --watch```
