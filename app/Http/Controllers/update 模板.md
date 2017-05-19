<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">begin%20%20declare%20%20%20ierrCount%20smallint;%20%20%20szDjBh%20Varchar%2820%29;%20%20%20iRowCount%20smallint%20;%20%20%20iFlen%20int%20;%20%20begin%20%20%20declare%20%20%20%20%20iPDh%20int%20;%20%20%20%20%20szRBH%20%20char%286%29%20;%20%20%20%20%20TempExp%20Exception%20;%20%20%20begin%20%20select%20%27000938%27%20into%20szDjBh%20from%20dual%20;%20%20select%20count%28%2A%29%20into%20iRowCount%20from%20zb_zfpzml_y%20%20where%20gsdm=%27001%27%20%20%20%20and%20kjnd=%272017%27%20%20%20%20and%20pdqj=%27201705%27%20%20and%20dwshr_id=%2D1%20%20%20%20and%20pdh=%2722794%27%20;%20%20if%20iRowCount%26gt;0%20then%20%20update%20ZB_ZFPZNR_Y%20set%20%20%20%20stamp=stamp%2B1%2C%20%20%20zjxzdm=%279%27%2C%20%20%20%20zffsdm=%2702%27%2C%20%20%20%20jsfsdm=%272%27%2C%20%20%20%20yskmdm=%272299901%27%2C%20%20%20%20jflxdm=%2730299%27%2C%20%20%20%20zclxdm=%270202%27%2C%20%20%20%20ysgllxdm=%272%27%2C%20%20%20%20zblydm=%277%27%2C%20%20%20%20xmdm=%279%27%2C%20%20%20%20XMFLDM=%27_%27%2C%20%20%20YWLXDM=%27_%27%2C%20%20%20SJWH=%27_%27%2C%20%20%20BJWH=%27_%27%2C%20%20%20KZZLDM1=%27_%27%2C%20%20%20KZZLDM2=%27_%27%2C%20%20%20zbje=800000%2C%20%20%20%20yyzbje=256540%2E51%2C%20%20%20%20kyzbje=543459%2E49%2C%20%20%20%20JHID=%27%27%2C%20%20%20ZBID=%27001%2E2017%2E0%2E5789%27%2C%20%20%20je=1%20%20where%20gsdm=%27001%27%20%20%20%20and%20kjnd=%272017%27%20%20%20%20and%20pdqj=%27201705%27%20%20%20%20and%20pdh=%2722794%27%20;%20%20update%20zb_zfpzml_y%20set%20%20%20%20DJZT=%270%27%2C%20%20%20Pdrq=%2720170519%27%2C%20%20%20%20Dzkdm=%2723%27%2C%20%20%20%20Ysdwdm=%27901006001%27%2C%20%20%20%20djbh=%27000938%27%2C%20%20%20%20zphm=%27_%27%2C%20%20%20%20Fkrdm=%2700030005%27%2C%20%20%20%20Fkr=%27%CB%EC%B4%A8%CF%D8%C3%B6%BD%AD%D5%F2%B2%C6%D5%FE%CB%F9%A3%A8%C1%E3%D3%E0%B6%EE%D5%CB%BB%A7%A3%A9%27%2C%20%20%20%20Fkryhbh=%2700030005%27%2C%20%20%20%20Fkzh=%27178157750000004662%27%2C%20%20%20%20Fkrkhyh=%27%C5%A9%C9%CC%D0%D0%C3%B6%BD%AD%B7%D6%C0%ED%B4%A6%27%2C%20%20%20%20Fkyhhh=%27012%27%2C%20%20%20%20Skrdm=%27_%27%2C%20%20%20%20Skr=%27%D1%EE%C1%F9%D0%E3%27%2C%20%20%20%20Skryhbh=%27_%27%2C%20%20%20%20Skzh=%276221884350010060164%27%2C%20%20%20%20Skrkhyh=%27%D6%D0%B9%FA%D3%CA%D5%FE%D2%F8%D0%D0%CB%EC%B4%A8%CF%D8%D6%A7%D0%D0%27%2C%20%20%20%20SKyhhh=%27_%27%2C%20%20%20%20Zy=%27%CD%CB%BC%C6%C9%FA%D6%AA%C7%E9%D1%A1%D4%F1%B1%A3%D6%A4%BD%F0%27%2C%20%20%20%20FJS=0%2C%20%20%20%20xjbz=%270%27%2C%20%20%20%20ZZPZ=%270%27%2C%20%20%20%20PJPCHM=%27_%27%2C%20%20%20%20bz2=%270%27%20%2Ccxbz=%270%27%20%20where%20Gsdm=%27001%27%20%20%20%20and%20KJND=%272017%27%20%20%20%20and%20PDQJ=%27201705%27%20%20%20%20and%20PDH=%2722794%27%20;%20%20Update%20ZB_ZFPZNR_Y_MC%20Set%20KZZLMC1=%27%27%2CKZZLMC2=%27%27%2CZBLYMC=%27%C6%E4%CB%FB%D6%B8%B1%EA%27%2CZJXZMC=%27%C6%E4%CB%FB%D7%CA%BD%F0%27%2CYSKMMC=%27%C6%E4%CB%FB%D6%A7%B3%F6%27%2CYSKMQC=%27%C6%E4%CB%FB%D6%A7%B3%F6%2D%C6%E4%CB%FB%D6%A7%B3%F6%2D%C6%E4%CB%FB%D6%A7%B3%F6%27%2CJFLXMC=%27%C6%E4%CB%FB%C9%CC%C6%B7%BA%CD%B7%FE%CE%F1%D6%A7%B3%F6%27%2CJFLXQC=%27%C9%CC%C6%B7%BA%CD%B7%FE%CE%F1%D6%A7%B3%F6%2D%C6%E4%CB%FB%C9%CC%C6%B7%BA%CD%B7%FE%CE%F1%D6%A7%B3%F6%27%2CZCLXMC=%27%CA%DA%C8%A8%D6%A7%B8%B6%27%2CYSGLLXMC=%27%CF%E7%D5%F2%D6%A7%B3%F6%27%2CDZKMC=%27%CF%E7%B2%C6%B9%C9%27%2CXMMC=%27%C6%E4%CB%FB%D7%CA%BD%F0%27%2CXMFLMC=%27%27%20%2CYSDWMC=%27%C3%B6%BD%AD%D5%F2%D0%D0%D5%FE%27%2CYSDWQC=%27%C3%B6%BD%AD%D5%F2%D0%D0%D5%FE%27%2CYWLXMC=%27%27%20%2CZFFSMC=%27%CA%DA%C8%A8%D6%A7%B8%B6%27%20%2CJSFSMC=%27%D7%AA%D5%CB%27%2CNEWDYBZ=%27%CE%B4%B4%F2%D3%A1%27%2CNEWZZPZ=%27%D6%BD%D6%CA%27%2CNEWCXBZ=%27%D5%FD%B3%A3%C6%BE%D6%A4%27%2CNEWPZLY=%27%D5%FD%B3%A3%27%2CNEWZT=%27%D5%FD%B3%A3%27%20Where%20Gsdm%20=%27001%27%20and%20Kjnd=%272017%27%20and%20ZFLB=%270%27%20and%20PDH=22794%20and%20PDQJ=%27201705%27;%20%20%20%20%20%20commit;%20%20%20%20%20select%2022794%20into%20ierrCount%20from%20dual%20;%20%20else%20rollback;%20end%20if%20;%20%20%20Exception%20%20%20%20%20when%20others%20then%20%20%20%20%20%20%20RollBack;%20%20%20%20%20%20%20select%200%20into%20ierrCount%20from%20dual%20;%20%20%20end%20;%20%20%20Open%20:pRecCur%20for%20%20%20%20%20select%20ierrCount%20RES%2CszDJBH%20DJBH%20from%20dual;%20%20end;%20end;%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>

----------------

<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">begin  declare   ierrCount smallint;   szDjBh Varchar(20);   iRowCount smallint ;   iFlen int ;  begin   declare     iPDh int ;     szRBH  char(6) ;     TempExp Exception ;   begin  select '000938' into szDjBh from dual ;  select count(*) into iRowCount from zb_zfpzml_y  where gsdm='001'    and kjnd='2017'    and pdqj='201705'  and dwshr_id=-1    and pdh='22794' ;  if iRowCount&gt;0 then  update ZB_ZFPZNR_Y set    stamp=stamp+1,   zjxzdm='9',    zffsdm='02',    jsfsdm='2',    yskmdm='2299901',    jflxdm='30299',    zclxdm='0202',    ysgllxdm='2',    zblydm='7',    xmdm='9',    XMFLDM='_',   YWLXDM='_',   SJWH='_',   BJWH='_',   KZZLDM1='_',   KZZLDM2='_',   zbje=800000,    yyzbje=256540.51,    kyzbje=543459.49,    JHID='',   ZBID='001.2017.0.5789',   je=1  where gsdm='001'    and kjnd='2017'    and pdqj='201705'    and pdh='22794' ;  update zb_zfpzml_y set    DJZT='0',   Pdrq='20170519',    Dzkdm='23',    Ysdwdm='901006001',    djbh='000938',    zphm='_',    Fkrdm='00030005',    Fkr='遂川县枚江镇财政所（零余额账户）',    Fkryhbh='00030005',    Fkzh='178157750000004662',    Fkrkhyh='农商行枚江分理处',    Fkyhhh='012',    Skrdm='_',    Skr='杨六秀',    Skryhbh='_',    Skzh='6221884350010060164',    Skrkhyh='中国邮政银行遂川县支行',    SKyhhh='_',    Zy='退计生知情选择保证金',    FJS=0,    xjbz='0',    ZZPZ='0',    PJPCHM='_',    bz2='0' ,cxbz='0'  where Gsdm='001'    and KJND='2017'    and PDQJ='201705'    and PDH='22794' ;  Update ZB_ZFPZNR_Y_MC Set KZZLMC1='',KZZLMC2='',ZBLYMC='其他指标',ZJXZMC='其他资金',YSKMMC='其他支出',YSKMQC='其他支出-其他支出-其他支出',JFLXMC='其他商品和服务支出',JFLXQC='商品和服务支出-其他商品和服务支出',ZCLXMC='授权支付',YSGLLXMC='乡镇支出',DZKMC='乡财股',XMMC='其他资金',XMFLMC='' ,YSDWMC='枚江镇行政',YSDWQC='枚江镇行政',YWLXMC='' ,ZFFSMC='授权支付' ,JSFSMC='转账',NEWDYBZ='未打印',NEWZZPZ='纸质',NEWCXBZ='正常凭证',NEWPZLY='正常',NEWZT='正常' Where Gsdm ='001' and Kjnd='2017' and ZFLB='0' and PDH=22794 and PDQJ='201705';      commit;     select 22794 into ierrCount from dual ;  else rollback; end if ;   Exception     when others then       RollBack;       select 0 into ierrCount from dual ;   end ;   Open :pRecCur for     select ierrCount RES,szDJBH DJBH from dual;  end; end; </DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>

dwshr_id=-1

```

<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">begin  declare   ierrCount smallint;   szDjBh Varchar(20);   iRowCount smallint ;   iFlen int ;  begin   declare     iPDh int ;     szRBH  char(6) ;     TempExp Exception ;   begin  select '000931' into szDjBh from dual ;  select count(*) into iRowCount from zb_zfpzml_y  where gsdm='001'    and kjnd='2017'    and 

                                                   pdqj='201705'  and  


                                                   
  
                                                     pdh='22708' ; 
             if iRowCount&gt;0 then  

                update ZB_ZFPZNR_Y set          
je=320 
             where gsdm='001'    and kjnd='2017'    and 
                                                       pdqj='201705' 
                                  and 
                                                      pdh='22708' ;  

update zb_zfpzml_y set      
  
Zy='农业局开会培训'  , Skr='杨六秀'

where Gsdm='001'    and KJND='2017'    and 

                                                        PDQJ='201705'    and 
                                                        PDH='22708' ;                                                                                           
commit;     select 100 into ierrCount from dual ;  else rollback; end if ;   Exception     when others then       RollBack;       select 0 into ierrCount from dual ;   end ;   Open :pRecCur for     select ierrCount RES,szDJBH DJBH from dual;  end; end; </DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>
```




Pdrq='20170519',          
Skr='杨六秀',      
Skzh='6221884350010060164',    
Skrkhyh='中国邮政银行遂川县支行',  

注意
修改000931
修改3个201705
修改3个22708

第一个update修改金额
第二个update修改收款人信息和摘要日期Pdrq='20170519',
