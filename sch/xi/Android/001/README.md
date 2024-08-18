# Resource
- https://www.iconfinder.com/icons/386451/arch_linux_archlinux_icon

# Reference

## Design
- https://youtu.be/O17fvn7kztg?si=uACikGYlFsePHb-r # Profile
- https://youtu.be/XMI1iejmtzs?si=5WzLT188RYHXzDLe # Login/Register

## Layout
- https://stackoverflow.com/questions/45776994/android-gridlayout-columnspan-not-spanning
- https://stackoverflow.com/questions/2710793/what-is-the-equivalent-of-colspan-in-an-android-tablelayout # no

## Intent
- https://www.geeksforgeeks.org/how-to-make-a-phone-call-from-an-android-application/
- https://stackoverflow.com/questions/68808796/how-can-you-launch-termux-through-another-android-app
- https://stackoverflow.com/questions/3872063/how-to-launch-an-activity-from-another-application-in-android # Intent with package name
- https://stackoverflow.com/questions/3631982/change-applications-starting-activity # Change starting activity


# -
## Design
### Satuan
- dp(Density-independent Pixels) -> Konsisten pada setiap ukuran layar.
- sp(Scale-independent Pixels)   -> Menyesuaikan dengan ukuran layar.

### Styles
#### -
Semisal ada sebuah style seperti dibawah
```xml
<style name="main_info_text">
    <item name="android:layout_width">wrap_content</item>
    <item name="android:layout_height">wrap_content</item>
    <item name="android:textStyle">bold</item>
    <item name="android:textColor">@color/white</item>
</style>
```

Kemudian saya ingin membuat style baru yang mewarisi `main_info_text` dengan beberapa penambahan
```xml
<style name="main_info_text_value">
    <item name="android:textSize">10sp</item>
</style>
```

Agar `main_info_text_value` mewarisi `main_info_text`, tambahkan `parent` sehingga menjadi
```xml
<style name="main_info_text_value" parent="main_info_text">
    <item name="android:textSize">10sp</item>
</style>
```

### LinearLayout
#### Attribute
- `android:gravity`         -> Mengatur elemen didalam layout/child.
- `android:layout_gravity`  -> Mengatur LinearLayout itu sendiri.

### Fungsi CardView
- Memberi Bayangan -> `app:cardElevation`
- Memberi Radius   -> `app:cardCornerRadius`

### Fungsi LinearLayout yang berisi TextView, View, dan Button
Fungsi utamanya adalah agar teks register dan button dapat bersebelahan.
Hal ini dilakukan dengan `android:orientation="horizontal"`.

Jika menggunakan RelativeLayout, hal ini dapat dilakukan hanya dengan `android:layout_toRightOf`.

## Code
### Mengganti MainActivity
Pada Manifest file terdapat
```xml
<activity
    android:name=".MainActivity"
    android:exported="true" >
        <intent-filter>/
            <action android:name="android.intent.action.MAIN" />
            <category android:name="android.intent.category.LAUNCHER" />
        </intent-filter>
</activity>
```

Jika ingin mengganti ke Activity lain dapat dilakukan dengan memindahnya.

```xml
<activity
    android:name=".LoginActivity"
    android:exported="false" >
    <intent-filter>
        <action android:name="android.intent.action.MAIN" />
        <category android:name="android.intent.category.LAUNCHER" />
    </intent-filter>
</activity>
```

Jangan lupa ubah MainActivity menjadi seperti berikut agar tidak terjadi kesalahan yang tidak terduga
```xml
<activity
android:name=".MainActivity"
android:exported="true" />
```
Jika ketika run, LoginActivity tidak secara otomatis terbuka, ubah `android:exported` menjadi `true`.

### Lambda
Pada sebelum sebelumnya, intent dilakukan dengan menggunakan _Anonymous classes_ seperti pada code dibawah

```java
findViewById(R.id.btn_youtube).setOnClickListener(new View.OnClickListener() {
    @Override
    public void onClick(View v) {
        Intent YouTube = new Intent(Intent.ACTION_VIEW, Uri.parse("https://youtube.com/"));
        startActivity(YouTube);
    }
});
```

Hal tersebut sebenarnya dapat dipersingkat dengan lambda
```java
findViewById(R.id.btn_github).setOnClickListener(v -> {
    Intent Github = new Intent(Intent.ACTION_VIEW, Uri.parse("https://github.com/Aspiann17"));
    startActivity(Github);
});
```