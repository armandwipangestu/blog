### Cara Install Di Localhost

- Clone atau Download Repository

```bash
git clone --depth=1 https://github.com/armandwipangestu/blog/
```

- Buat Directory untuk menampung gambar pada postingan

```bash
mkdir blog/assets/img/post
```

- Ubah Permission folder `img/post`

```bash
chmod 777 blog/assets/img/post 
```

- Ubah query koneksi terhadap mysql pada file `function/functions.php`

```php
return mysqli_connect("localhost", "username", "password", "db_for_blog");
```

### Demo Website

[demo.xshin.tech](http://demo.xshin.tech)

- Username: `demo`
- Password: `demo`
