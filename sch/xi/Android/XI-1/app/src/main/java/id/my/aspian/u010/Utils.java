package id.my.aspian.u010;

import android.content.Context;
import android.widget.Toast;

import java.text.NumberFormat;
import java.util.Locale;

public class Utils {
    public static NumberFormat formatter = NumberFormat.getCurrencyInstance(new Locale("id", "ID"));

    public static void toast(Context context, String... messages) {
        for (String message : messages) {
            Toast.makeText(context, message, Toast.LENGTH_SHORT).show();
        }
    }

    public static String format(long number) {
        return formatter.format(number).replace(",00", "");
    }

//            new MaterialAlertDialogBuilder(this)
//                    .setTitle("Hapus Item")
//                    .setMessage("Apakah Anda yakin ingin menghapus item ini?")
//                    .setNegativeButton("Batal", (dialog, which) -> {})
//                    .setPositiveButton("Do", (dialog, which) -> {})
//                    .show();
}