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

> NOTE: Simpan di dalam folder htdocs

```bash
git clone --depth=1 https://github.com/armandwipangestu/blog/
```

- Membuat database dengan nama `demo_blog`

- Import SQL File

```sql
Upload file demo_blog.sql ke dalam database `demo_blog` melalui phpmyadmin

```

- Ubah query koneksi terhadap mysql pada file `function/functions.php`

```php
return mysqli_connect("localhost", "username", "password", "demo_blog");
```

### Demo Website

<hr>

- Link Website: [armandwipangestu.rf.gd/demo_blog/](http://armandwipangestu.rf.gd/demo_blog/)

- Username: `demo`
- Password: `demo`

### Sebagai user

https://user-images.githubusercontent.com/64394320/185077351-e60a473f-ef4a-4ac0-ac71-9fe72a001d4c.mp4

### Sebagai admin

https://user-images.githubusercontent.com/64394320/185077988-51612d16-02df-44e2-9cea-7bd00a63eaf2.mp4

