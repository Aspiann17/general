package id.my.aspian.u010;

import android.database.sqlite.SQLiteDatabase;

public class Users {
    Koneksi koneksi;

    public Users(Koneksi koneksi) {
        this.koneksi = koneksi;
    }

    public static void create_table(SQLiteDatabase db, String table_name) {
        db.execSQL(
            "CREATE TABLE IF NOT EXISTS" + table_name + "(" +
                "`id` INTEGER PRIMARY KEY AUTOINCREMENT" +
                "`username` TEXT NOT NULL UNIQUE," +
                "`password` TEXT NOT NULL," +
                "`role` TEXT CHECK(`status` IN (`user`, `owner`))," +
                "`created_at` DATE DEFAULT CURRENT_DATE" +
            ");"
        );
    }
}