Dim ObjExcel, ObjWB
Set ObjExcel = CreateObject("excel.application")
'vbs opens a file specified by the path below
Set ObjWB = ObjExcel.Workbooks.Open("C:\xampp\htdocs\--LIVE--\regus.bca\Email_Sender.xlsm")
'either use the Workbook Open event (if macros are enabled), or Application.Run