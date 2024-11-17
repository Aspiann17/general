package id.my.aspian.u010;

import android.app.Dialog;
import android.content.Intent;
import android.os.Bundle;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.google.android.material.dialog.MaterialAlertDialogBuilder;

import java.util.ArrayList;
import java.util.HashMap;

import static id.my.aspian.u010.Utils.*;

public class ProductListActivity extends AppCompatActivity {
    ListView list_product;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_product_list);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        // Menerima data dari Activity sebelumnya.
        Bundle data = getIntent().getExtras();
        String product_type = null;

        if (data != null) {
            product_type = data.getString("type");
        } else {
            toast(this, "Terjadi kesalahan saat menerima data pada Activity sebelumnya");
            finish();
        }

        // Dialog untuk `amount`
        Dialog option = new Dialog(this);
        option.setContentView(R.layout.list_product_dialog);

        EditText raw_amount = option.findViewById(R.id.amount);

        // Membersihkan input `amount` ketika dialog ditutup.
        option.setOnDismissListener(dialog -> raw_amount.getText().clear());

        list_product = findViewById(R.id.list_product);
        list_product.setOnItemClickListener((parent, view, position, id) -> {
            String product_id = ((TextView) view.findViewById(R.id.product_id)).getText().toString();

            option.show();
            option.findViewById(R.id.add).setOnClickListener(v -> {
                String string_amount = raw_amount.getText().toString();

                if (string_amount.isEmpty()) {
                    toast(this, "Jumlah belum di isi!");
                    return;
                }

                int amount = Integer.parseInt(string_amount);
            });
        });

        tmp_data();
    }

    private void tmp_data() {
        ArrayList<HashMap<String, String>> list_product_data = new ArrayList<>();

        for (int i = 0; i < 50; i++) {
            HashMap<String, String> map = new HashMap<>();
            map.put("product_id", "1" + i);
            map.put("product_type", "food" + i);
            map.put("product_name", "Ehe" + i);
            map.put("product_rating", "" + i);
            map.put("product_price", format(50000 + i));
            map.put("product_price_discount", "" + i);
            map.put("product_description", "Kosong" + i);

            list_product_data.add(map);
        };

        SimpleAdapter list_product_adapter = new SimpleAdapter(
                this, list_product_data, R.layout.list_product,
                new String[]{
                    "product_id", "product_type", "product_name", "product_price",
                    "product_price_discount", "product_rating", "product_description"
                }, new int[]{
                    R.id.product_id, R.id.product_type, R.id.product_name, R.id.product_price,
                    R.id.product_price_discount, R.id.product_rating, R.id.product_description
                }
        );

        list_product.setAdapter(list_product_adapter);
    }
}