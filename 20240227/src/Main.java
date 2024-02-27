import java.util.Scanner;

class Input {
    static Scanner sc = new Scanner(System.in);

    public static int Int(String text) {
        while (true) {
            System.out.print(text);
            try {
                if (sc.hasNextInt()) {
                    return sc.nextInt();
                } else {
                    throw new java.util.InputMismatchException();
                }
            } catch (java.util.InputMismatchException e) {
                sc.next();
                System.out.println("Invalid input!!!");
            } catch (Exception e) {
                System.out.println(e);
            }
        }
    }
}

class MyMath {
    static float gravity = 9.8f;

    public class Energy {
        // Kinetik Energi

        public static double potential(double m, double h) {
            // 
            return MyMath.gravity * m * h;
        }

        public static double kinetic(double m, double v) {

            return 0;
        }
    }

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
            String[] lformula = {
                "c² = b² + a²",
                "b² = c² - a²",
                "a² = c² - b²"
            };
            int inp, x, y;

            System.out.println("============================");
            for (int i = 0; i < lformula.length; i++) {
                System.out.printf(" %d.%s\n",i + 1,lformula[i]);
            }
            System.out.println("============================");
            inp = Input.Int("Choose: ");


            x = Input.Int(String.format(
                "Masukkan nilai %s: ", (inp == 2 || inp == 3) ? "c" : "b"
            ));
            y = Input.Int(String.format(
                "Masukkan nilai %s: ", (inp == 1 || inp == 2) ? "a" : "b"
            ));

            // a = 3;
            // b = 4;
            // c = 5;    

            switch (inp) {
                case 1:
                    System.out.printf("%d² + %d² = %.02f\n", x,y,Phytagoras.c(y,x));
                    break;
                    
                case 2:
                    System.out.printf("%d² - %d² = %.02f\n", x,y,Phytagoras.b(x,y));
                    break;
                    
                case 3:
                    System.out.printf("%d² - %d² = %.02f\n", x,y,Phytagoras.a(x,y));
                    break;

                default:
                    break;
            }
        }
    }
    
}

class Main {
    
    public static void menu() {
        String[] lmenu = {
            "sssd",
            "asdad"
        };
        
        System.out.println("""
            ============================
            |        Main Menu         |
            ============================""");
            for (int i = 0; i < lmenu.length; i++) {
                System.out.printf(" %d.%s\n",i + 1,lmenu[i]); // Change later > "Aku Atomik":^10
            }
            System.out.println("============================");
            
            while (true) {
                switch (Input.Int("Choose: ")) {
                    case 1:
                        break;

                    default:
                        break;
                }
            }
        }

    public static void main(String[] args) {
        MyMath.Phytagoras.main();
        Input.sc.close();
    }
}