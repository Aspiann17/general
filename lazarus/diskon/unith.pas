unit unith;

{$mode objfpc}{$H+}

interface

uses
  Classes, SysUtils, Forms, Controls, Graphics, Dialogs, StdCtrls;

type

  { TForm1 }

  TForm1 = class(TForm)
    bhitung: TButton;
    breset: TButton;
    bclose: TButton;
    pelanggan: TCheckBox;
    oharga: TEdit;
    odiskon: TEdit;
    ototal: TEdit;
    ukuran: TComboBox;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Label7: TLabel;
    pria: TRadioButton;
    wanita: TRadioButton;
    procedure bcloseClick(Sender: TObject);
    procedure bhitungClick(Sender: TObject);
    procedure bresetClick(Sender: TObject);
    procedure FormCreate(Sender: TObject);
  private

  public

  end;

var
  Form1: TForm1;

implementation

{$R *.lfm}

{ TForm1 }

procedure TForm1.FormCreate(Sender: TObject);
begin
  pria.Checked := False;
  wanita.Checked := False;

  ukuran.Text := '';

  pelanggan.Checked := False;

  oharga.Text := '';
  odiskon.Text := '';
  ototal.Text := '';
end;

procedure TForm1.bcloseClick(Sender: TObject);
begin
  application.terminate;
end;

procedure TForm1.bhitungClick(Sender: TObject);
const apria:Array[0..2] of real = (500000, 550000, 600000);
const awanita:Array[0..2] of real = (450000, 500000, 550000);
var harga, diskon, total : real;
begin
  harga := 0;
  diskon := 0;
  total := 0;

  if pria.Checked then
  begin
    harga := apria[ukuran.ItemIndex];
  end;

  if wanita.Checked then
  begin
    harga := awanita[ukuran.ItemIndex];
  end;

  if pelanggan.Checked then
  begin
    diskon := harga * (10/100)
  end;


  oharga.Text := currtostr(harga);
  odiskon.Text := currtostr(diskon);
  ototal.Text := currtostr(harga - diskon);
end;

procedure TForm1.bresetClick(Sender: TObject);
begin
  pria.Checked := False;
  wanita.Checked := False;

  ukuran.Text := '';

  pelanggan.Checked := False;

  oharga.Text := '';
  odiskon.Text := '';
  ototal.Text := '';
end;

end.

