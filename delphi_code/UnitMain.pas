unit UnitMain;

interface

uses
  Winapi.Windows, Winapi.Messages, System.SysUtils, System.Variants, System.Classes, Vcl.Graphics,
  Vcl.Controls, Vcl.Forms, Vcl.Dialogs, Data.DB, Vcl.Menus, Vcl.Grids,
  Vcl.DBGrids, Vcl.StdCtrls, Vcl.Buttons, Datasnap.Provider, Data.FMTBcd,
  Data.DBXMySQL, Data.SqlExpr, FireDAC.Stan.Intf, FireDAC.Stan.Option,
  FireDAC.Stan.Error, FireDAC.UI.Intf, FireDAC.Phys.Intf, FireDAC.Stan.Def,
  FireDAC.Stan.Pool, FireDAC.Stan.Async, FireDAC.Phys, FireDAC.Phys.MySQL,
  FireDAC.Phys.MySQLDef, FireDAC.VCLUI.Wait, FireDAC.Comp.Client,
  FireDAC.Stan.Param, FireDAC.DatS, FireDAC.DApt.Intf, FireDAC.DApt,
  FireDAC.Phys.SQLiteVDataSet, FireDAC.Comp.DataSet;

type
  TForm2 = class(TForm)
    DBGrid1: TDBGrid;
    MainMenu1: TMainMenu;
    N1: TMenuItem;
    N2: TMenuItem;
    N3: TMenuItem;
    N4: TMenuItem;
    N5: TMenuItem;
    N6: TMenuItem;
    N7: TMenuItem;
    N8: TMenuItem;
    N9: TMenuItem;
    N10: TMenuItem;
    BitBtn1: TBitBtn;
    N11: TMenuItem;
    N12: TMenuItem;
    N13: TMenuItem;
    N14: TMenuItem;
    N15: TMenuItem;
    N16: TMenuItem;
    Credentials1: TMenuItem;
    DataSource1: TDataSource;
    FDConnection1: TFDConnection;
    FDQuery1: TFDQuery;
    FDLocalSQL1: TFDLocalSQL;
    FDQuery1id: TFDAutoIncField;
    FDQuery1comment: TWideStringField;
    FDQuery1company_name: TWideStringField;
    FDQuery1rate: TWideStringField;
    FDQuery1contact_person: TWideStringField;
    FDQuery1email: TWideStringField;
    FDQuery1phone: TWideStringField;
    FDQuery1position_name: TWideStringField;
    FDQuery1position_description: TWideMemoField;
    FDQuery1position_source: TWideStringField;
    FDQuery1position_link: TWideStringField;
    FDQuery1created: TDateTimeField;
    FDQuery1updated: TDateTimeField;
    FDQuery1archived: TBooleanField;
    FDQuery1answered: TBooleanField;
    FDQuery1answer_text: TWideMemoField;
    FDQuery1manual_rank: TIntegerField;
    FDQuery1automatic_rank: TIntegerField;
    FDQuery1company_city: TWideStringField;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form2: TForm2;

implementation

{$R *.dfm}

end.
