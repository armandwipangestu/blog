### Teknologi Yang Digunakan
<hr>

- HTML
- CSS <br>
└─ [Bootstrap](https://getbootstrap.com/)<br>
└─ [Font Awesome](https://fontawesome.com/)
- Javascript <br>
└─ [SweetAlert2](https://sweetalert2.github.io/)<br>
└─ [Highlight JS](https://highlightjs.org/)
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

- Screenshot Light Theme:
<br>
<a href="https://i.ibb.co/qrzCK9T/image.png" target="_blank">
  <img src="https://i.ibb.co/qrzCK9T/image.png" />
</a>

<a href="https://i.ibb.co/k26sdV9/image.png" target="_blank">
  <img src="https://i.ibb.co/k26sdV9/image.png" />
</a>

<a href="https://i.ibb.co/41mB13T/image.png" target="_blank">
  <img src="https://i.ibb.co/41mB13T/image.png" />
</a>

<a href="https://i.ibb.co/vH18632/image.png" target="_blank">
  <img src="https://i.ibb.co/vH18632/image.png" />
</a>

- Screenshot Dark Theme:
<br>
<a href="https://i.ibb.co/RH8xMBh/image.png" target="_blank">
  <img src="https://i.ibb.co/RH8xMBh/image.png" />
</a>

<a href="https://i.ibb.co/LpCHYbT/image.png" target="_blank">
  <img src="https://i.ibb.co/LpCHYbT/image.png" />
</a>

<a href="https://i.ibb.co/6DJ99Hr/image.png" target="_blank">
  <img src="https://i.ibb.co/6DJ99Hr/image.png" />
</a>

<a href="https://i.ibb.co/P1rtyfv/image.png" target="_blank">
  <img src="https://i.ibb.co/P1rtyfv/image.png" />
</a>
