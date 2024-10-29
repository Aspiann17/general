package id.my.aspian.l009;

import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.widget.EditText;
import android.widget.RadioGroup;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class AddActivity extends AppCompatActivity {
    Koneksi koneksi = new Koneksi(this);;
    String status = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_add);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        EditText Rvalue = findViewById(R.id.jumlah);
        EditText Rketerangan = findViewById(R.id.keterangan);
        RadioGroup RRGstatus = findViewById(R.id.status);

        RRGstatus.setOnCheckedChangeListener((group, checkedId) -> status = (checkedId == R.id.masuk) ? "masuk" : "keluar" );

        findViewById(R.id.save).setOnClickListener(v -> {
            if (status.isEmpty()) toast("Pilih Status!!");
            else if (Rvalue.getText().toString().isEmpty()) toast("Isi Nilai");
            else if (Rketerangan.getText().toString().isEmpty()) toast("Isi Keterangan");
            else {
                SQLiteDatabase db = koneksi.getWritableDatabase();
                String query = String.format(
                        "INSERT INTO %s (status, jumlah, keterangan) VALUES ('%s', '%s', %s)",
                        Koneksi.TABLE_NAME, Rvalue.getText().toString(), Rketerangan.getText().toString()
                );

                db.execSQL(query);
                toast("Data berhasil disimpan!");
            }
        });
    }

    public void toast(String message) {
        Toast.makeText(this, message, Toast.LENGTH_SHORT).show();
    }
}