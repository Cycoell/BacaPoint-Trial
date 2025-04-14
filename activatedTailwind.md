# Panduan Menjalankan Tailwind CSS di Terminal

## Pastikan Versi Tailwind 3.14

```bash
npm uninstall @tailwindcss/cli
npm uninstall tailwindcss
```

```bash
npm install -D tailwindcss@3
npx tailwindcss init
```

## 1. Menjalankan Tailwind CSS

### Untuk membangun (build) CSS sekali:

```sh
npm run build
```

### Untuk mode pengawasan (watch mode):

```sh
npm run watch
```

### Untuk menghentikan Tailwind CSS di terminal:

Gunakan kombinasi tombol berikut:

```sh
Ctrl + C
```

## 2. Instalasi Tailwind CSS

### Instal Tailwind CSS menggunakan npm:

```sh
npm install tailwindcss @tailwindcss/cli
npm install -D tailwindcss postcss autoprefixer
```

## 3. Konfigurasi Tailwind CSS

### Buat file `tailwind.config.js` di root proyek dan isi dengan:

```js
export default {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {},
  },
  plugins: [],
};
```

### Buat file `postcss.config.js` di root proyek dan isi dengan:

```js
export default {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
};
```

### Buat file `src/input.css` dan isi dengan:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

## 4. Mengompilasi Tailwind Secara Manual

Gunakan perintah berikut untuk mengompilasi Tailwind secara manual:

```sh
npx tailwindcss -i ./src/input.css -o ./css/styles.css --watch
```

## 5. Tambahkan Tailwind ke File Code

```sh
<link href="./css/styles.css" rel="stylesheet">
```
