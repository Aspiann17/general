package id.my.aspian.l011;

import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.fragment.app.Fragment;

import com.google.android.material.bottomnavigation.BottomNavigationView;

import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity {
    BottomNavigationView bottom_menu;
    Menu toolbar_menu;
    List<MenuItem> toolbar_items = new ArrayList<>();

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.main_toolbar_menu, menu);
        toolbar_menu = menu;
        for (int i = 0; i < menu.size(); i++) toolbar_items.add(menu.getItem(i));
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, 10);
            return insets;
        });

        bottom_menu = findViewById(R.id.bottom_menu);
        bottom_menu.setOnItemSelectedListener(item -> {
            int item_id = item.getItemId();

            if (item_id == R.id.nav_home) {
                show_menu(List.of(R.id.add_folder));
                move_fragment(new HomeFragment());
                return true;
            } else if (item_id == R.id.nav_video) {
                show_menu(List.of(R.id.add_folder));
                move_fragment(new VideoFragment());
                return true;
            } else if (item_id == R.id.nav_history) {
                show_menu(List.of(R.id.delete_all));
                move_fragment(new HistoryFragment());
                return true;
            } else if (item_id == R.id.nav_directory) {
                show_menu(List.of(R.id.add_folder, R.id.delete_all));
                move_fragment(new DirectoryFragment());
                return true;
            }

            return false;
        });

        bottom_menu.setSelectedItemId(R.id.nav_home);
    }

    private void move_fragment(Fragment fragment) {
        getSupportFragmentManager().beginTransaction().replace(R.id.main_frame, fragment).commit();
    }

    private void show_menu(List<Integer> items) {
        for (MenuItem item : toolbar_items) {
            item.setVisible(items.contains(item.getItemId()));
        }
    }

    public void toast(String... message) {
        for (String m : message) {
            Toast.makeText(this, m, Toast.LENGTH_SHORT).show();
        }
    }
}