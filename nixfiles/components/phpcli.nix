{ pkgs, cfg }:

let
  # phpIni = (import ./phpini.nix) {inherit pkgs ;};
  myPhp = pkgs.php80.buildEnv {
    # extensions = { all, ... }: with all; [ ];
    extraConfig = ''
      post_max_size=50M
      upload_max_filesize=50M
      memory_limit=512M
      '';
  };
in
{
  buildInputs = with pkgs; [ myPhp php80Packages.composer ];

  shellInit = ''
    export COMPOSER_MEMORY_LIMIT=-1
    '';
  # shellInit = ''
  #   export COMPOSER_MEMORY_LIMIT=-1
  #   export PHP_INI=${phpIni}
  #   alias php="${pkgs.php}/bin/php -c ${phpIni}"
  #   '';

  shellStartService = ''
  '';

  shellStopService = ''
  '';

  shellDump = ''
  '';

  shellRestore = ''
  '';
}
