package id.my.aspian.t007;

import android.graphics.drawable.TransitionDrawable;
import android.os.Bundle;
import android.view.Window;
import android.widget.ImageView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class MainActivity extends AppCompatActivity {
    int index = 0;

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

        Window window = getWindow();
        window.setNavigationBarColor(ContextCompat.getColor(this, R.color.primary));
//        window.setStatusBarColor(ContextCompat.getColor(this, R.color.primary));

        ImageView picture = findViewById(R.id.picture);
        int[] drawables = {R.drawable.tr_1, R.drawable.tr_2, R.drawable.tr_3};

        // Indeks akan bertambah satu setiap kali tombol ditekan dan
        // akan direset menjadi '0' jika mimiliki nilai sama dengan panjang array.
        findViewById(R.id.change).setOnClickListener(v -> {

            picture.setImageResource(drawables[index]);
            ((TransitionDrawable) picture.getDrawable()).startTransition(500);

            index++;
            if (index >= drawables.length) index = 0;
        });
    }
}