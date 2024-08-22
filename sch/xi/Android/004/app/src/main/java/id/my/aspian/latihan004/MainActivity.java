package id.my.aspian.latihan004;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class MainActivity extends AppCompatActivity {
    EditText input1 = findViewById(R.id.input1), input2 = findViewById(R.id.input2);
    TextView output = findViewById(R.id.output);
    float satu = Integer.parseInt(input1.getText().toString()), dua = Integer.parseInt(input2.getText().toString());

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
    }

    public void tambah(View v) {
        output.setText(String.valueOf(satu + dua));
    }

    public void kurang(View v) {
        output.setText(String.valueOf(satu - dua));
    }

    public void kali(View v) {
        output.setText(String.valueOf(satu * dua));
    }

    public void bagi(View v) {
        output.setText(String.valueOf(satu / dua));
    }
}