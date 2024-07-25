import java.util.Scanner;

// Debug
// import java.util.Arrays;

class Util {
    // public static String block = "========================================================";
    public static String block = "=".repeat(56);

    public static void view(String text, String[] list_menu) {                
        System.out.println("\n".repeat(200));
        
        System.out.printf("%s%n%s%n",block,text);
        System.out.println("|------------------------------------------------------|");
        for (int i = 0; i < list_menu.length; i++) {
            System.out.printf("| %d | %-48s |%n", i+1, list_menu[i]);
        }

        System.out.printf("| %d | %-48s |%n", 0,"Back");

        System.out.println(block);
    }

    // String[]... = *args
    public static String[] merge_array(String[]... array) {
        int array_lenght = 0, index = 0;

        for (String[] arr : array) {
            array_lenght += arr.length;
        }

        String[] tmp = new String[array_lenght];

        for (String[] arr : array) {
            for (String item : arr) {
                tmp[index++] = item;
            }
        }
        return tmp;
    }
}

class Input {
    static Scanner sc = new Scanner(System.in);

    public static int iint(String text) {
        while (true) {
            System.out.print(text);
            try {
                if (sc.hasNextInt()) {
                    return sc.nextInt();
                } else {
                    sc.next();
                    throw new java.util.InputMismatchException();
                }
            } catch (java.util.InputMismatchException e) {
                System.out.println("Invalid input!!!");
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    public static double idouble(String text) {
        while (true) {
            System.out.print(text);
            try {
                if (sc.hasNextDouble()) {
                    return sc.nextDouble();
                } else {
                    sc.next();
                    throw new java.util.InputMismatchException();
                }
            } catch (java.util.InputMismatchException e) {
                System.out.println("Invalid input!!!");
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    public static void ivoid() {
        System.out.println("Ketik apapun kecuali spasi lalu tekan enter.");
        sc.next();
        sc.nextLine();
    }
}

class MyMath {

    public class Phytagoras {
        public static double c(double a, double b) {
            return Math.sqrt(
                Math.pow(a, 2) + Math.pow(b, 2)
            );
        }

        public static double b(double c, double a) {
            return Math.sqrt(
                Math.pow(c, 2) - Math.pow(a, 2)
            );
        }

        public static double a(double c, double b) {
            return Math.sqrt(
                Math.pow(c, 2) - Math.pow(b, 2)
            );
        }

        public static void main() {
            String text = "|                      Phytagoras                      |";
            double x, y, hasil;
            int inp;
            String[] lformula = {
                "c² = b² + a²",
                "b² = c² - a²",
                "a² = c² - b²"
            }; Util.view(text, lformula);

            while (true) {
                inp = Input.iint("Choose: ");

                if (inp == 0) {
                    return;
                } else if (inp > lformula.length) {
                    System.out.println("Invalid input!");
                    continue;
                } else {
                    System.out.println("Invalid input!");
                    break;
                }
            }

            x = Input.idouble(String.format(
                "Masukkan nilai %s: ", (inp == 2 || inp == 3) ? "c" : "b"
            ));
            y = Input.idouble(String.format(
                "Masukkan nilai %s: ", (inp == 1 || inp == 2) ? "a" : "b"
            ));

            hasil = switch (inp) {
                case 1 -> c(y, x);
                case 2 -> b(x, y);
                case 3 -> a(x, y);
                default -> throw new IllegalArgumentException(); // Imposible line
            };


            if (Double.isNaN(hasil)) {
                System.out.printf("Output: %s merupakan bilangan imajiner%n", hasil);
                Input.ivoid();
                return;
            }

            System.out.printf(
                "%.02f² %s %.02f² = %.03f\n", x, (inp == 1) ? "+" : "-", y, hasil
            );
            Input.ivoid();
        }
    }

    // public class Resistor {        
    //     public static void main() {
    //         String text = "|                       Resistor                       |";
    //         String[] lformula = {
    //             "V = I x R",
    //             "R = V / I",
    //             "I = V / R"
    //         }; Util.view(text, lformula);
    //         while (true) {
    //             int inp = Input.iint("Choose: ");
    //             if (inp > lformula.length) {
    //                 System.out.println("Invalid input!");
    //                 continue;
    //             } break;
    //         }
    //     }
    // }
}

class Main {

    public static int menu() {
        String text = "|                       Main Menu                      |";
        String[] list =  {
            "Phytagoras",
        }; Util.view(text, list);

        switch (Input.iint("Choose: ")) {
            case 1:
                MyMath.Phytagoras.main();
                break;
            case 0:
                return 0;
            default:
                System.out.println("Invalid input!!");
                break;
        }
        return 505;
    }

    public static void main(String[] args) {     
        String[] Bug = {
            "Terjadi bug yang tidak diketahui jika user tidak memasukkan apa apa pada input yang disediakan.",
            "Jika user memasukkan sembarang karakter ditambah dengan spasi dan diiringin dengan nomor dari opsi yang ada, program akan masuk pada nomor yang diinput, tetapi tetap menampilkan pesan kalau input tidak valid. Contoh: \"i !use arch btw 1\"",
            "Dan banyak lagi bug yang semuanya terkait dengan input"
        };
        boolean debug = false;

        try {
            if (debug) {
                System.out.println("\n".repeat(2));
                for (String bug : Bug) {
                    System.out.println(bug);
                } Input.ivoid();
                System.out.println("\n".repeat(2));
            }

            while (true) {
                switch (menu()) {
                    case 0:
                        return;
                    default:
                        continue;
                }
            }
        } finally { Input.sc.close(); }
    }
}