package id.my.aspian.u010;

import android.app.Dialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.WindowManager;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import java.util.ArrayList;
import java.util.HashMap;

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

        Intent intent = new Intent();
        String type = intent.getStringExtra("type");

        Dialog option = new Dialog(this);
        option.setContentView(R.layout.list_product_dialog);
        option.findViewById(R.id.close).setOnClickListener(v -> option.dismiss());

        list_product = findViewById(R.id.list_product);
        list_product.setOnItemClickListener((parent, view, position, id) -> {
            String product_id = ((TextView) view.findViewById(R.id.product_id)).getText().toString();

            option.show();
            option.findViewById(R.id.add).setOnClickListener(v -> {
                String string_amount = ((EditText) option.findViewById(R.id.amount)).getText().toString();

                if (string_amount.isEmpty()) {
                    Utils.toast(this, "Jumlah belum di-isi!");
                    return;
                }

                Utils.toast(this, string_amount);
            });
        });

        tmp_data();
    }

    private void tmp_data() {
        ArrayList<HashMap<String, String>> list_product_data = new ArrayList<>();

        HashMap<String, String> map = new HashMap<>();
        map.put("product_name", "Ehe");
        map.put("product_rating", "5");
        map.put("product_price", "50000");
        map.put("product_price_discount", "0");
        map.put("product_description", "Kosong");

        for (int i = 0; i < 50; i++) list_product_data.add(map);

        SimpleAdapter list_product_adapter = new SimpleAdapter(
                this, list_product_data, R.layout.list_product,
                new String[] {"product_name", "product_price", "product_price_discount", "product_rating","product_description"},
                new int[] {R.id.product_name, R.id.product_price, R.id.product_price_discount, R.id.product_rating, R.id.product_description}
        );

        list_product.setAdapter(list_product_adapter);
    }
}