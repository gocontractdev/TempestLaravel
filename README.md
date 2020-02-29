<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Tempest

This is a sample Laravel Project.

## Commands

We have a scheduled command for deleting old news feed; in order to activate it one should save either of the following commands:

1- Scheduling:

```$xslt
crontab -e

* * * * * cd /home/javaher/PhpstormProjects/Tempest && php artisan schedule:run >> /dev/null 2>&1
```

2- Direct Command (I usually prefer this way):

```$xslt

30 2 * * * cd /home/javaher/PhpstormProjects/Tempest && php artisan news:kill-old-feed

```


## Postman Collection / Configuration

Postman collection is available at:

https://drive.google.com/file/d/1GlW_xVguJgPVOgVdDwbgnOHeNA_A4FOc/view?usp=sharing

Postman environment is available at:

https://drive.google.com/file/d/13KyACM2BmVFgn17gTo-jd8agI7VnveL7/view?usp=sharing


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
