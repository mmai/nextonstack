{ pkgs, cfg }:

{
  buildInputs = with pkgs; [ php80 ];

  name = "phpfpm";

  shellInit = ''
    '';

  shellStartService = ''
  '';

  shellStopService = ''
  '';

  shellDump = ''
  '';

  shellRestore = ''
  '';
  customCommands = ''
    '';
}
