package id.my.aspian.l009;

import android.app.AlertDialog;
import android.app.Dialog;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.view.WindowManager;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import java.util.ArrayList;
import java.util.HashMap;

public class MainActivity extends AppCompatActivity {
    Koneksi koneksi;
    ArrayList<HashMap<String, String>> arus_kas = new ArrayList<>();
    ListView list_transaksi;
    SwipeRefreshLayout swipeRefresh;
    public static String item_id = "";

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

        findViewById(R.id.add).setOnClickListener(v -> startActivity(new Intent(this, AddActivity.class)));

        koneksi = new Koneksi(this);

        swipeRefresh = findViewById(R.id.refresh);
        swipeRefresh.setOnRefreshListener(this::reload);
        swipeRefresh.setRefreshing(false);

        list_transaksi = findViewById(R.id.list_transaksi);
        list_transaksi.setOnItemClickListener((parent, view, position, id) -> {
            item_id = ((TextView) view.findViewById(R.id.id)).getText().toString();

            Dialog dialog = new Dialog(this);
            dialog.setContentView(R.layout.list_menu);
            dialog.getWindow().setLayout(
                    WindowManager.LayoutParams.MATCH_PARENT,
                    WindowManager.LayoutParams.WRAP_CONTENT
            ); dialog.show();

            dialog.findViewById(R.id.delete).setOnClickListener(v -> {
                dialog.dismiss();

                AlertDialog.Builder alert = new AlertDialog.Builder(this);
                alert.setTitle("Hapus Data? " + item_id);
                alert.setMessage("Yakin ingin menghapus data ini?");
                alert.setNegativeButton("False", (dialog1, which) -> toast("Ehe"));
                alert.setPositiveButton("True", (dialog1, which) -> {
                    SQLiteDatabase db = koneksi.getWritableDatabase();
                    db.execSQL(String.format(
                            "DELETE FROM %s WHERE id = '%s'",
                            Koneksi.TABLE_NAME, item_id
                    ));

                    toast("Data " + item_id + " berhasil dihapus!");
                    reload();
                });

                alert.show();
            });

            dialog.findViewById(R.id.update).setOnClickListener(v -> {
                dialog.dismiss();
                startActivity(new Intent(this, UpdateActivity.class));
            });
        });

        reload();
    }

    @Override
    protected void onResume() {
        super.onResume();
        reload();
    }

    private void reload() {
        arus_kas.clear();
        show_data();
        show_total();

        swipeRefresh.setRefreshing(false);
    }

    private void show_data() {
        SQLiteDatabase db = koneksi.getReadableDatabase();
        Cursor cursor = db.rawQuery("SELECT *, STRFTIME('%d-%m-%Y', tanggal) AS tanggall FROM " + Koneksi.TABLE_NAME, null);

        if (cursor != null && cursor.moveToFirst()) {
            do {
                HashMap<String, String> map = new HashMap<>();
                map.put("id", cursor.getString(0));
                map.put("status", cursor.getString(1));
                map.put("jumlah", cursor.getString(2));
                map.put("keterangan", cursor.getString(3));
                map.put("tanggal", cursor.getString(5));

                arus_kas.add(map);
            } while (cursor.moveToNext());

            cursor.close();
        }

        SimpleAdapter simple_katanya = new SimpleAdapter(
                this, arus_kas, R.layout.list_items,
                new String[] {"id", "status", "jumlah", "keterangan", "tanggal"},
                new int[] {R.id.id, R.id.status, R.id.jumlah, R.id.keterangan, R.id.tanggal}
        );

        list_transaksi.setAdapter(simple_katanya);
    }

    private void show_total() {
        SQLiteDatabase db = koneksi.getReadableDatabase();

        Cursor cursor = db.rawQuery(
            "SELECT SUM(jumlah)," +
                    "(SELECT SUM(jumlah) FROM " + Koneksi.TABLE_NAME + " WHERE status = 'Masuk') as jumlah_masuk," +
                    "(SELECT SUM(jumlah) FROM " + Koneksi.TABLE_NAME + " WHERE status = 'Keluar') as jumlah_keluar" +
                    " FROM " + Koneksi.TABLE_NAME, null
        );

        if (cursor != null) cursor.moveToFirst();

        TextView masuk = findViewById(R.id.pemasukan);
        TextView keluar = findViewById(R.id.pengeluaran);
        TextView saldo = findViewById(R.id.saldo);

        double pemasukan = cursor != null ? cursor.getDouble(1) : 0;
        double pengeluaran = cursor != null ? cursor.getDouble(2) : 0;

        masuk.setText(String.valueOf(pemasukan));
        keluar.setText(String.valueOf(pengeluaran));
        saldo.setText(String.valueOf(pemasukan - pengeluaran));

        if (cursor != null) cursor.close();
    }

    public void toast(String message) {
        Toast.makeText(this, message, Toast.LENGTH_SHORT).show();
    }
}