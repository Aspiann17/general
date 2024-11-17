package id.my.aspian.u010;

import android.content.Intent;
import android.os.Bundle;
import android.view.Window;
import android.widget.ListView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

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

        // Toolbar
        Window window = getWindow();
        window.setStatusBarColor(ContextCompat.getColor(this, R.color.primary));

        list_transaction = findViewById(R.id.list_transaction);

        findViewById(R.id.food_card).setOnClickListener(v -> {
            Intent intent = new Intent(this, ProductListActivity.class);
            intent.putExtra("type", "food");
            startActivity(intent);
        });

        findViewById(R.id.drink_card).setOnClickListener(v -> {
            Intent intent = new Intent(this, ProductListActivity.class);
            intent.putExtra("type", "drink");
            startActivity(intent);
        });
    }
}