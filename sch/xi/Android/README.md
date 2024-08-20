# Style
## Atribut Style
Semisal saya memiliki beberapa/banyak edit text seperti dibawah 
```xml
<EditText
    android:id="@+id/username"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:layout_marginTop="20dp"
    android:background="@drawable/edittext"
    android:drawableLeft="@drawable/icon_username"
    android:drawablePadding="8dp"
    android:hint="Username"
    android:inputType="text|textAutoComplete"
    android:padding="10dp"
    android:textColor="@color/black"
    android:textColorHint="#8D8D8D" />

<EditText
    android:id="@+id/password"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:layout_marginTop="20dp"
    android:background="@drawable/edittext"
    android:drawableLeft="@drawable/icon_password"
    android:drawablePadding="8dp"
    android:hint="Password"
    android:inputType="text|textPassword"
    android:padding="10dp"
    android:textColor="@color/black"
    android:textColorHint="#8D8D8D" />
```

Jika diamati, terdapat banyak pengulangan code.
Hal ini tidak sesuai dengan perinsip [DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself).

Hal lain yang menjadi potensi masalah adalah menjaga konsistensi antara satu sama lain.

Hal ini dapat diatasi dengan mendefinisikan sebuah/beberapa style pada file `res/values/styles.xml`.

Contoh isi file `styles.xml`
```xml
<?xml version="1.0" encoding="utf-8"?>
<resources>
    <style name="basic_input">
        <item name="android:layout_width">match_parent</item>
        <item name="android:layout_height">wrap_content</item>
        <item name="android:layout_marginTop">20dp</item>
        <item name="android:padding">10dp</item>
        <item name="android:textColor">#000</item>
        <item name="android:textColorHint">#8D8D8D</item>
        <item name="android:drawablePadding">8dp</item>
        <item name="android:background">@drawable/edittext</item>
    </style>

    <style name="other_style">...</style>
<resources>
```

Untuk menerapaknnya cukup dengan menambah atribut `style` pada tiap tag. Contoh
```xml
<EditText
    android:id="@+id/username"
    android:hint="Username"
    android:inputType="text|textAutoComplete"
    style="@style/basic_input" />

<EditText
    android:id="@+id/password"
    android:hint="Password"
    android:inputType="text|textPassword"
    style="@style/basic_input" />
```

## Mewarisi Style
Semisal ada sebuah style seperti berikut
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

# Layout
## LinearLayout
### Attribute
- `android:gravity`         -> Mengatur elemen didalam layout/child.
- `android:layout_gravity`  -> Mengatur LinearLayout itu sendiri.

# Code
## Mengganti activity yang pertama kali dibuka
Ketika aplikasi baru dijalankan/dibuka, activity yang pertama kali dijalankan adalah MainActivity.
Hal tersebut dapat diubah dengan konfigurasi pada AndroidManifest.

AndroidManifest default:
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

## Intent

### Implicit


Iqro': ***https://developer.android.com/guide/components/intents-common***


### Explicit
Biasa digunakan untuk berpindah dari satu activity ke activity lain didalam aplikasi yang sama.

Contoh code:
```java
public void to_main(View v) {
    Intent intent = new Intent(getApplicationContext(), MainActivity.class);
    startActivity(intent);
}
```

`MainActivity` merupakan nama activity yang dituju.

### Class Intent

### Tambahan

#### -
```xml
android:onClick="onClick"
android:clickable="true"
```

# Referensi
## Intent
- https://developer.android.com/guide/components/intents-common
- https://www.geeksforgeeks.org/what-is-intent-in-android/
- https://stackoverflow.com/questions/3328757/how-to-click-or-tap-on-a-textview-text
- https://stackoverflow.com/questions/7578236/how-to-send-hashmap-value-to-another-activity-using-an-intent