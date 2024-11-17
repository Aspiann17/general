package id.my.aspian.u010;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class Koneksi extends SQLiteOpenHelper {
    private static final String DB_NAME = "test_01";
    private static final int DB_VERSION = 1;

    public Koneksi(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        Users.create_table(db, "users");
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int old_version, int new_version) {}
}