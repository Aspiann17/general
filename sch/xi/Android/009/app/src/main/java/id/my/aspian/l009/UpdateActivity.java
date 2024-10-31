package id.my.aspian.l009;

import android.app.DatePickerDialog;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.Calendar;

public class UpdateActivity extends AppCompatActivity {
    Koneksi koneksi;
    String status = "";

    EditText Rvalue, Rketerangan, Rdate;
    RadioGroup Rstatus;
    RadioButton Rmasuk, Rkeluar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_update);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        koneksi = new Koneksi(this);

        Rmasuk = findViewById(R.id.masuk);
        Rkeluar = findViewById(R.id.keluar);
        Rvalue = findViewById(R.id.jumlah);
        Rketerangan = findViewById(R.id.keterangan);
        Rdate = findViewById(R.id.date);
        Rstatus = findViewById(R.id.status);

        Rstatus.setOnCheckedChangeListener((group, checkedId) -> {
            if (checkedId == R.id.masuk) status = "Masuk";
            else if (checkedId == R.id.keluar) status = "Keluar";
        });

        init();

        Rdate.setOnClickListener(v -> {
            Calendar calendar = Calendar.getInstance();
            int tahun = calendar.get(Calendar.YEAR);
            int bulan = calendar.get(Calendar.MONTH);
            int tanggal = calendar.get(Calendar.DAY_OF_MONTH);

            DatePickerDialog date_picker = new DatePickerDialog(this, (view, year, month, dayOfMonth) -> {
                NumberFormat DF = new DecimalFormat("00");
                Rdate.setText(year + "-" + DF.format(month + 1) + "-" +  DF.format(dayOfMonth));
            }, tahun, bulan, tanggal);
            date_picker.show();
        });

        findViewById(R.id.update).setOnClickListener(v -> update());
    }

    public void update() {
        if (status.isEmpty()) toast("Pilih Status!!");
        else if (Rvalue.getText().toString().isEmpty()) toast("Isi Nilai");
        else if (Rketerangan.getText().toString().isEmpty()) toast("Isi Keterangan");
        else if (Rdate.getText().toString().isEmpty()) toast("Isi Keterangan");
        else {
            SQLiteDatabase db = koneksi.getWritableDatabase();
            String[] param = {
                    status, Rvalue.getText().toString(), Rketerangan.getText().toString(),
                    Rdate.getText().toString(), MainActivity.item_id
            };

            db.execSQL("UPDATE " + Koneksi.TABLE_NAME + " SET status = ?, jumlah = ?, keterangan = ?, tanggal = ? WHERE id = ?", param);
            toast("Data berhasil diubah?");
            finish();
        }
    }

    public void init() {
        SQLiteDatabase db = koneksi.getReadableDatabase();
        Cursor cursor = db.rawQuery(String.format(
                "SELECT * FROM %s WHERE id = %s",
                Koneksi.TABLE_NAME, MainActivity.item_id
        ), null);

        if (cursor != null && cursor.moveToFirst()) {

            if (cursor.getString(1).equals("Masuk")) {
                Rmasuk.setChecked(true);
            } else {
                Rkeluar.setChecked(true);
            }

            Rvalue.setText(cursor.getString(2));
            Rketerangan.setText(cursor.getString(3));
            Rdate.setText(cursor.getString(4));

            cursor.close();
        }
    }

    public void toast(String message) {
        Toast.makeText(this, message, Toast.LENGTH_SHORT).show();
    }
}