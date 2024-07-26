{ pkgs ? import <nixpkgs> {} }:

let
  VERSION = 0.1;
in

pkgs.mkShell {
  buildInputs = with pkgs; [
    php82
    php82Packages.composer
    php82Extensions.pdo
    php82Extensions.sqlite3
  ];

  shellHook = ''
    echo "PHP version: $(php -v | head -n 1)"
  '';
}