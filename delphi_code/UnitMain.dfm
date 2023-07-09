object Form2: TForm2
  Left = 0
  Top = 0
  Caption = 'Find a Job'
  ClientHeight = 568
  ClientWidth = 823
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -12
  Font.Name = 'Segoe UI'
  Font.Style = []
  Menu = MainMenu1
  TextHeight = 15
  object DBGrid1: TDBGrid
    Left = 8
    Top = 8
    Width = 807
    Height = 497
    DataSource = DataSource1
    TabOrder = 0
    TitleFont.Charset = DEFAULT_CHARSET
    TitleFont.Color = clWindowText
    TitleFont.Height = -12
    TitleFont.Name = 'Segoe UI'
    TitleFont.Style = []
    Columns = <
      item
        Expanded = False
        FieldName = 'id'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'comment'
        Width = 200
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'company_name'
        Width = 200
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'rate'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'contact_person'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'email'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'phone'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'position_name'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'position_description'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'position_source'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'position_link'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'created'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'updated'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'archived'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'answered'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'answer_text'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'manual_rank'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'automatic_rank'
        Visible = True
      end
      item
        Expanded = False
        FieldName = 'company_city'
        Visible = True
      end>
  end
  object BitBtn1: TBitBtn
    Left = 740
    Top = 535
    Width = 75
    Height = 25
    Caption = 'E&xit'
    Kind = bkClose
    NumGlyphs = 2
    TabOrder = 1
  end
  object MainMenu1: TMainMenu
    Left = 120
    Top = 24
    object N1: TMenuItem
      Caption = #1055#1086#1076#1075#1086#1090#1086#1074#1082#1072
      object N11: TMenuItem
        Caption = #1051#1080#1076#1099' '#1074#1088#1091#1095#1085#1091#1102
      end
      object N12: TMenuItem
        Caption = #1051#1080#1076#1099' '#1080#1079' '#1087#1086#1095#1090#1099
      end
      object N2: TMenuItem
        Caption = #1057#1082#1072#1085' '#1083#1080#1076#1086#1074' '#1085#1072' '#1089#1072#1081#1090#1072#1093
      end
      object N5: TMenuItem
        Caption = #1057#1086#1089#1090#1072#1074#1083#1077#1085#1080#1077' '#1088#1077#1079#1102#1084#1077
      end
      object N3: TMenuItem
        Caption = #1057#1072#1081#1090#1099' '#1088#1072#1073#1086#1090#1099
      end
      object N6: TMenuItem
        Caption = #1055#1086#1095#1090#1086#1074#1099#1077' '#1103#1097#1080#1082#1080
      end
      object N4: TMenuItem
        Caption = #1042#1099#1093#1086#1076
      end
    end
    object N13: TMenuItem
      Caption = #1044#1077#1081#1089#1090#1074#1080#1103
    end
    object N14: TMenuItem
      Caption = #1057#1087#1088#1072#1074#1086#1095#1085#1080#1082#1080
      object N15: TMenuItem
        Caption = #1057#1072#1081#1090#1099' '#1088#1072#1073#1086#1090#1099
      end
      object N16: TMenuItem
        Caption = #1055#1086#1095#1090#1086#1074#1099#1077' '#1103#1097#1080#1082#1080
      end
      object Credentials1: TMenuItem
        Caption = 'Credentials'
      end
    end
    object N7: TMenuItem
      Caption = #1056#1077#1079#1091#1083#1100#1090#1072#1090#1099
      object N8: TMenuItem
        Caption = #1057#1090#1072#1090#1080#1089#1090#1080#1082#1072
      end
    end
    object N9: TMenuItem
      Caption = #1057#1087#1088#1072#1074#1082#1072
      object N10: TMenuItem
        Caption = #1054' '#1087#1088#1086#1075#1088#1072#1084#1084#1077
      end
    end
  end
  object DataSource1: TDataSource
    DataSet = FDQuery1
    Left = 184
    Top = 160
  end
  object FDConnection1: TFDConnection
    Params.Strings = (
      'Database=jobsearch'
      'User_Name=jobsearch'
      'Password=jobsearch'
      'Server=localhost'
      'CharacterSet=utf8mb4'
      'DriverID=MySQL')
    Connected = True
    Left = 104
    Top = 248
  end
  object FDQuery1: TFDQuery
    Active = True
    LocalSQL = FDLocalSQL1
    Connection = FDConnection1
    SQL.Strings = (
      'select * from positions')
    Left = 312
    Top = 256
    object FDQuery1id: TFDAutoIncField
      FieldName = 'id'
      Origin = 'id'
      ProviderFlags = [pfInWhere, pfInKey]
    end
    object FDQuery1comment: TWideStringField
      AutoGenerateValue = arDefault
      FieldName = 'comment'
      Origin = 'comment'
      Size = 266
    end
    object FDQuery1company_name: TWideStringField
      AutoGenerateValue = arDefault
      FieldName = 'company_name'
      Origin = 'company_name'
      Size = 266
    end
    object FDQuery1rate: TWideStringField
      AutoGenerateValue = arDefault
      FieldName = 'rate'
      Origin = 'rate'
      Size = 133
    end
    object FDQuery1contact_person: TWideStringField
      AutoGenerateValue = arDefault
      FieldName = 'contact_person'
      Origin = 'contact_person'
      Size = 266
    end
    object FDQuery1email: TWideStringField
      AutoGenerateValue = arDefault
      FieldName = 'email'
      Origin = 'email'
      Size = 266
    end
    object FDQuery1phone: TWideStringField
      AutoGenerateValue = arDefault
      FieldName = 'phone'
      Origin = 'phone'
      Size = 266
    end
    object FDQuery1position_name: TWideStringField
      FieldName = 'position_name'
      Origin = 'position_name'
      Required = True
      Size = 266
    end
    object FDQuery1position_description: TWideMemoField
      AutoGenerateValue = arDefault
      FieldName = 'position_description'
      Origin = 'position_description'
      BlobType = ftWideMemo
    end
    object FDQuery1position_source: TWideStringField
      AutoGenerateValue = arDefault
      FieldName = 'position_source'
      Origin = 'position_source'
      Size = 666
    end
    object FDQuery1position_link: TWideStringField
      FieldName = 'position_link'
      Origin = 'position_link'
      Required = True
      Size = 666
    end
    object FDQuery1created: TDateTimeField
      AutoGenerateValue = arDefault
      FieldName = 'created'
      Origin = 'created'
    end
    object FDQuery1updated: TDateTimeField
      AutoGenerateValue = arDefault
      FieldName = 'updated'
      Origin = 'updated'
    end
    object FDQuery1archived: TBooleanField
      AutoGenerateValue = arDefault
      FieldName = 'archived'
      Origin = 'archived'
    end
    object FDQuery1answered: TBooleanField
      AutoGenerateValue = arDefault
      FieldName = 'answered'
      Origin = 'answered'
    end
    object FDQuery1answer_text: TWideMemoField
      FieldName = 'answer_text'
      Origin = 'answer_text'
      Required = True
      BlobType = ftWideMemo
    end
    object FDQuery1manual_rank: TIntegerField
      AutoGenerateValue = arDefault
      FieldName = 'manual_rank'
      Origin = 'manual_rank'
    end
    object FDQuery1automatic_rank: TIntegerField
      AutoGenerateValue = arDefault
      FieldName = 'automatic_rank'
      Origin = 'automatic_rank'
    end
    object FDQuery1company_city: TWideStringField
      AutoGenerateValue = arDefault
      FieldName = 'company_city'
      Origin = 'company_city'
      Size = 133
    end
  end
  object FDLocalSQL1: TFDLocalSQL
    Connection = FDConnection1
    DataSets = <>
    Left = 280
    Top = 360
  end
end
