在线预备党员考试系统
===============================

本项目基于 [Yii 2](http://www.yiiframework.com/) 高级应用模板 advance 用于开发具有多层的复杂Web应用程序

项目包括三个层：前端，后端和控制台，每个都是单独的Yii应用程序。

该项目暂时部署在develop版本，项目功能正在开发中～

项目代码说明在 [docs/guide/README.md](docs/guide/README.md).


# 本地部署考试系统


## PHP初始化
  * 以下命令皆在项目目录下执行, 自行安装环境。(windows 和 linux操作系统可能稍微有些区别，以下以linux为例)

  * 安装依赖

    ```
    composer install
    ```

  * 初始化数据库

    创建数据库：
    
    ```
    CREATE DATABASE `kaoshi` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
    ```
    修改配置文件(编辑自己的配置文件，配置数据库连接)：

    ```
    sudo vim common/config/main-local.php
    ```

    创建数据库表：

    ```
    ./yii migrate
    ```

    程序会初始化表。