package id.my.aspian.latihan001;

import android.os.Bundle;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

// Intent
import android.content.Intent;
import android.widget.Button;
import android.view.View;
import android.net.Uri;


public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });


        // Github Intent
        findViewById(R.id.btn_github).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent Igithub = new Intent(Intent.ACTION_VIEW, Uri.parse("https://github.com/Aspiann17"));
                startActivity(Igithub);
            }
        });

        // Youtube Intent
        findViewById(R.id.btn_youtube).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent Iyoutube = new Intent(Intent.ACTION_VIEW, Uri.parse("https://youtube.com/"));
                startActivity(Iyoutube);
            }
        });

        // Shopee Intent
        findViewById(R.id.btn_shopee).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent Ishopee = new Intent(Intent.ACTION_VIEW, Uri.parse("https://shopee.co.id/"));
                startActivity(Ishopee);
            }
        });

        // Telepon Intent
        // Jangan lupa ganti nomor pada /app/res/values/strings.xml
        findViewById(R.id.btn_call).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String phone_number = String.format("tel:%s", R.string.phone_number);
                Intent Icall = new Intent(Intent.ACTION_CALL, Uri.parse(phone_number));
                startActivity(Icall);
            }
        });

        // Termux Intent
        findViewById(R.id.btn_termux).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent Itermux = getPackageManager().getLaunchIntentForPackage("com.termux");
                if (Itermux != null) {
                    startActivity(Itermux);
                };
            }
        });

        // Nix on Droid Intent
        findViewById(R.id.btn_nod).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent Inod = getPackageManager().getLaunchIntentForPackage("com.termux.nix");
                if (Inod != null) {
                    startActivity(Inod);
                };
            }
        });

        // Facebook Intent
        findViewById(R.id.btn_facebook).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent Ifacebook = new Intent(Intent.ACTION_VIEW, Uri.parse("https://facebook.com"));
                startActivity(Ifacebook);
            }
        });

        // Design Intent
        findViewById(R.id.btn_design).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent Idesign = getPackageManager().getLaunchIntentForPackage("id.my.aspian.latihan001d");
                if (Idesign != null) {
                    startActivity(Idesign);
                };
            }
        });

        // Browser Intent
        findViewById(R.id.btn_browser).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent Ibrowser = new Intent(Intent.ACTION_VIEW, Uri.parse("https://kernel.org"));
                startActivity(Ibrowser);
            }
        });
    }
}