{ pkgs ? import <nixpkgs> {} }:

let
  VERSION = 0.1;
  # PORT = 8000;
in

pkgs.mkShell {
  buildInputs = with pkgs; [
    php82
    php82Extensions.pdo
    php82Extensions.sqlite3

    # apacheHttpd
    # apacheHttpdPackages.php
  ];

  shellHook = ''
    echo "PHP version: $(php -v | head -n 1)"
  '';
}