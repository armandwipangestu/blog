### Teknologi Yang Digunakan
<hr>

- HTML
- CSS <br>
└─ [Bootstrap](https://getbootstrap.com/)
- Javascript <br>
└─ [SweetAlert2](https://sweetalert2.github.io/)
- PHP <br>
└─ [Parsedown](https://github.com/erusev/parsedown)

### Cara Install Di Localhost
<hr>

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

- Import SQL File

```sql
Upload file demo_blog.sql ke dalam database melalui phpmyadmin

```

- Ubah query koneksi terhadap mysql pada file `function/functions.php`

```php
return mysqli_connect("localhost", "username", "password", "demo_blog");
```

### Demo Website
<hr>

- Link Website: [demo.xshin.tech](http://demo.xshin.tech)

- Username: `demo`
- Password: `demo`

- Screenshot:
<br>
<a href="https://i.ibb.co/chmfrQS/image.png" target="_blank">
  <img src="https://i.ibb.co/chmfrQS/image.png" />
</a>

<a href="https://i.ibb.co/dPcmB5s/image.png" target="_blank">
  <img src="https://i.ibb.co/dPcmB5s/image.png" />
</a>

<a href="https://i.ibb.co/phGzMTr/image.png" target="_blank">
  <img src="https://i.ibb.co/phGzMTr/image.png" />
</a>

<a href="https://i.ibb.co/p2LrgB7/image.png" target="_blank">
  <img src="https://i.ibb.co/p2LrgB7/image.png" />
</a>
