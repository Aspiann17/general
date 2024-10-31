package id.my.aspian.l009;

import android.app.DatePickerDialog;
import android.os.Bundle;
import android.widget.EditText;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.Calendar;

public class FilterActivity extends AppCompatActivity {
    EditText Rdari, Rsampai;
    NumberFormat decimal_format;
    Calendar calendar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_filter);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        calendar = Calendar.getInstance();
        decimal_format = new DecimalFormat("00");

        Rdari = findViewById(R.id.dari);
        Rsampai = findViewById(R.id.sampai);

        date_picker(Rdari);
        date_picker(Rsampai);

        findViewById(R.id.filter).setOnClickListener(v -> {
            if (Rdari.getText().toString().isEmpty() || Rsampai.getText().toString().isEmpty()) {
                Toast.makeText(this, "Tanggal belum diisi!", Toast.LENGTH_SHORT).show();
                return;
            }

            MainActivity.filter = true;
            MainActivity.tanggal_dari = Rdari.getText().toString();
            MainActivity.tanggal_sampai = Rsampai.getText().toString();

            finish();
        });
    }

    private void date_picker(EditText object) {
        object.setOnClickListener(v -> {
            DatePickerDialog date_dialog = new DatePickerDialog(this, (view, year, month, dayOfMonth) -> {
                object.setText(year + "-" + decimal_format.format(month + 1) + "-" + decimal_format.format(dayOfMonth));
            }, calendar.get(Calendar.YEAR), calendar.get(Calendar.MONTH), calendar.get(Calendar.DAY_OF_MONTH));

            date_dialog.show();
        });
    }
}