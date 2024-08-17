# Resource
- https://www.iconfinder.com/icons/386451/arch_linux_archlinux_icon


# Reference

## Design
- https://www.youtube.com/watch?v=04bzIg3Xuvg # Profile
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
## Fungsi CardView
- Memberi Bayangan -> `app:cardElevation`
- Memberi Radius   -> `app:cardCornerRadius`

## Fungsi LinearLayout yang berisi TextView, View, dan Button
Fungsi utamanya adalah agar teks register dan button dapat bersebelahan.
Hal ini dilakukan dengan `android:orientation="horizontal"`.

Jika menggunakan RelativeLayout, hal ini dapat dilakukan hanya dengan `android:layout_toRightOf`.

## Mengganti MainActivity
Pada Manifest file terdapat
`<activity
    android:name=".MainActivity"
    android:exported="true" >
        <intent-filter>/
            <action android:name="android.intent.action.MAIN" />
            <category android:name="android.intent.category.LAUNCHER" />
        </intent-filter>
</activity>`

Jika ingin mengganti ke Activity lain dapat dilakukan dengan memindahnya.

`<activity
    android:name=".LoginActivity"
    android:exported="false" >
    <intent-filter>
        <action android:name="android.intent.action.MAIN" />
        <category android:name="android.intent.category.LAUNCHER" />
    </intent-filter>
</activity>`

Jangan lupa ubah MainActivity menjadi seperti berikut agar tidak terjadi kesalahan yang tidak terduga
`<activity
android:name=".MainActivity"
android:exported="true" />`

Jika ketika run, LoginActivity tidak secara otomatis terbuka, ubah `android:exported` menjadi `true`.