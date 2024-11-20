package id.my.aspian.u010;

import static id.my.aspian.u010.Utils.toast;

import android.content.Intent;
import android.os.Bundle;
import android.view.Window;
import android.widget.ListView;
import android.widget.SimpleAdapter;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.google.android.material.bottomnavigation.BottomNavigationView;

import java.util.ArrayList;
import java.util.HashMap;

public class MainActivity extends AppCompatActivity {
    ListView list_category, list_transaction;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, 0);
            return insets;
        });

        // Toolbar
        Window window = getWindow();
        window.setStatusBarColor(ContextCompat.getColor(this, R.color.primary));
        // end

        // Category Intent
//        findViewById(R.id.food_card).setOnClickListener(v -> {
//            Intent intent = new Intent(this, ProductListActivity.class);
//            intent.putExtra("type", "food");
//            startActivity(intent);
//        });
        // end

        // Bottom Navigation
        BottomNavigationView bottom_nav = findViewById(R.id.bottom_navigation);
        bottom_nav.setOnItemSelectedListener(item -> {
            int item_id = item.getItemId();

            if (item_id == R.id.nav_home) {
                toast(this, "Home");
                return true;
            } else if (item_id == R.id.nav_cart) {
                toast(this, "Cart");
            } else if (item_id == R.id.nav_profile) {
                toast(this, "Profile");
            }

            return false;
        });
        // end
    }

//    private void tmp_data() {
//        ArrayList<HashMap<String, String>> list_transaction_data = new ArrayList<>();
//
//        for (int i = 0; i < 50; i++) {
//            HashMap<String, String> map = new HashMap<>();
//            map.put("transaction_id", "" + i);
//            map.put("transaction_name", "Ehe" + i);
//            map.put("transaction_type", "food" + i);
//            map.put("transaction_price", format(50000 + i));
//            map.put("transaction_amount", "" + i);
//
//            list_transaction_data.add(map);
//        }
//
//        SimpleAdapter list_product_adapter = new SimpleAdapter(
//            this, list_transaction_data, R.layout.list_transaction,
//            new String[]{
//                "transaction_id", "transaction_name", "transaction_type",
//                "transaction_price", "transaction_amount"
//            }, new int[]{
//                R.id.transaction_id, R.id.transaction_name, R.id.transaction_type,
//                R.id.transaction_price, R.id.transaction_amount
//            }
//        );
//
//        list_transaction.setAdapter(list_product_adapter);
//    }
//    https://stackoverflow.com/questions/17019359/implement-swipe-in-listview
//    https://medium.com/@Codeible/swipe-or-slide-and-drag-and-drop-items-in-recyclerview-6dbe4871f87
}