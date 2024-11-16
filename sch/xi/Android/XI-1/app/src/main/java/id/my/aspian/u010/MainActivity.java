package id.my.aspian.u010;

import android.content.Intent;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {
    ListView list_category, list_transaction;

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

        list_transaction = findViewById(R.id.list_transaction);

        Intent product_list = new Intent(this, ProductListActivity.class);

        findViewById(R.id.food_card).setOnClickListener(v -> {
            product_list.putExtra("type", "food");
            startActivity(product_list);
        });

        findViewById(R.id.drink_card).setOnClickListener(v -> {
            product_list.putExtra("type", "drink");
            startActivity(product_list);
        });
    }
}