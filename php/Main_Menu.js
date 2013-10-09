//Menu object creation
oCMenu=new makeCM("oCMenu"); //Making the menu object. Argument: menuname

//Menu properties
oCMenu.resizeCheck=1;
oCMenu.rows=1;
oCMenu.onlineRoot="";
oCMenu.offlineRoot=".";

oCMenu.pxBetween =0;
oCMenu.fillImg="cm_fill.gif";
oCMenu.fromTop=0;
oCMenu.fromLeft=0;
oCMenu.wait=300;
oCMenu.zIndex=400;
oCMenu.menuPlacement="left";

//Background bar properties
oCMenu.useBar=1;
oCMenu.barWidth="100%";
oCMenu.barHeight="menu";
oCMenu.barX=0;
oCMenu.barY="menu";
oCMenu.barClass="clBar";
oCMenu.barBorderX=0;
oCMenu.barBorderY=0;

//Level properties - ALL properties have to be spesified in level 0
oCMenu.level[0]=new cm_makeLevel(); //Add this for each new level
oCMenu.level[0].width=100;
oCMenu.level[0].height=21;
oCMenu.level[0].regClass="clLevel0";
oCMenu.level[0].overClass="clLevel0over";
oCMenu.level[0].borderX=1;
oCMenu.level[0].borderY=1;
oCMenu.level[0].borderClass="clLevel0border";
oCMenu.level[0].offsetX=0;
oCMenu.level[0].offsetY=0;
oCMenu.level[0].rows=0;
oCMenu.level[0].arrow=0;
oCMenu.level[0].arrowWidth=0;
oCMenu.level[0].arrowHeight=0;
oCMenu.level[0].align="bottom";


//EXAMPLE SUB LEVEL[1] PROPERTIES - You have to specify the properties you want different from LEVEL[0] - If you want all items to look the same just remove this
oCMenu.level[1]=new cm_makeLevel(); //Add this for each new level (adding one to the number)
oCMenu.level[1].width=140;
oCMenu.level[1].height=22;
oCMenu.level[1].regClass="clLevel1";
oCMenu.level[1].overClass="clLevel1over";
oCMenu.level[1].borderX=1;
oCMenu.level[1].borderY=1;
oCMenu.level[1].align="right";
oCMenu.level[1].offsetX=0;
oCMenu.level[1].offsetY=0;
oCMenu.level[1].borderClass="clLevel1border";
oCMenu.level[1].arrow="images\menu_arrow.gif";
oCMenu.level[1].arrowWidth=10;
oCMenu.level[1].arrowHeight=10;
oCMenu.level[1].align="right";


//EXAMPLE SUB LEVEL[2] PROPERTIES - You have to spesify the properties you want different from LEVEL[1] OR LEVEL[0] - If you want all items to look the same just remove this
//EXAMPLE SUB LEVEL[2] PROPERTIES - You have to specify the properties you want different from LEVEL[0] - If you want all items to look the same just remove this
oCMenu.level[2]=new cm_makeLevel(); //Add this for each new level (adding one to the number)
oCMenu.level[2].width=140;
oCMenu.level[2].height=22;
oCMenu.level[2].regClass="clLevel2";
oCMenu.level[2].overClass="clLevel2over";
oCMenu.level[2].borderX=1;
oCMenu.level[2].borderY=1;
oCMenu.level[2].align="right";
oCMenu.level[2].offsetX=0;
oCMenu.level[2].offsetY=0;
oCMenu.level[2].borderClass="clLevel2border";
oCMenu.level[2].arrow="images\menu_arrow.gif";
oCMenu.level[2].arrowWidth=10;
oCMenu.level[2].arrowHeight=10;
oCMenu.level[2].align="left";

//EXAMPLE SUB LEVEL[3] PROPERTIES - You have to specify the properties you want different from LEVEL[0] - If you want all items to look the same just remove this
oCMenu.level[3]=new cm_makeLevel(); //Add this for each new level (adding one to the number)
oCMenu.level[3].width=140;
oCMenu.level[3].height=22;
oCMenu.level[3].regClass="clLevel3";
oCMenu.level[3].overClass="clLevel3over";
oCMenu.level[3].borderX=1;
oCMenu.level[3].borderY=1;
oCMenu.level[3].align="right";
oCMenu.level[3].offsetX=0;
oCMenu.level[3].offsetY=0;
oCMenu.level[3].borderClass="clLevel3border";
oCMenu.level[3].arrow="images\menu_arrow.gif";
oCMenu.level[3].arrowWidth=10;
oCMenu.level[3].arrowHeight=10;
oCMenu.level[3].align="left";


/******************************************
Menu item creation:
myCoolMenu.makeMenu(name, parent_name, text, link, target, width, height, regImage, overImage, regClass, overClass , align, rows, nolink, onclick, onmouseover, onmouseout)
*************************************/
oCMenu.makeMenu('FileMenu','','Lists','');
oCMenu.makeMenu('Browsetcountry','FileMenu','Country List','Browsetcountrylist.php');
oCMenu.makeMenu('ITEM3','FileMenu','Department List','BrowseDeptlist.php');
oCMenu.makeMenu('ITEM2','FileMenu','Accounts List','BrowseChartlist.php');
oCMenu.makeMenu('ITEM4','FileMenu','Bank List','');
oCMenu.makeMenu('ITEM6','FileMenu','Category List','BrowseCategorylist.php');
oCMenu.makeMenu('ITEM8','FileMenu','Unit Measure List','BrowseUnitMeaslist.php');
oCMenu.makeMenu('ITEM9','FileMenu','Manufacturer List','BrowseManufacturerlist.php');
oCMenu.makeMenu('ITEM37','FileMenu','Location','BrowseLocationlist.php');
oCMenu.makeMenu('ITEM10','FileMenu','Books  Items List','BrowseItemslist.php');
oCMenu.makeMenu('ITEM11','FileMenu','Level List','BrowseLevellist.php');
oCMenu.makeMenu('ITEM36','FileMenu','Tier List','BrowseTierlist.php');
oCMenu.makeMenu('ITEM12','FileMenu','Room List','BrowseRoomlist.php');
oCMenu.makeMenu('ITEM13','FileMenu','Teachers List','BrowseTeacherlist.php');
oCMenu.makeMenu('ITEM5','FileMenu','Student List','BrowseStudentlist.php');
oCMenu.makeMenu('ITEM7','FileMenu','School Calendar','BrowseSchoolCalendarlist.php');
oCMenu.makeMenu('ITEM15','FileMenu','Attendance Status List','BrowseAttendanceStatuslist.php');
oCMenu.makeMenu('ITEM16','FileMenu','Progress List','BrowseTProgress1list.php');
oCMenu.makeMenu('ITEM17','FileMenu','Assessment List','BrowseAssessmentlist.php');
oCMenu.makeMenu('ITEM18','FileMenu','Seminar List','BrowseSeminarlist.php');
oCMenu.makeMenu('ITEM19','FileMenu','Payment Type List','BrowsePayTypelist.php');
oCMenu.makeMenu('ITEM20','FileMenu','Tax Code List','BrowseTaxlist.php');
oCMenu.makeMenu('ITEM21','FileMenu','Discount List','BrowseDiscountlist.php');
oCMenu.makeMenu('ITEM22','FileMenu','Royalty List','BrowseRoyaltylist.php');
oCMenu.makeMenu('ITEM23','FileMenu','Referral List','BrowseReferrallist.php');
oCMenu.makeMenu('ITEM24','FileMenu','Vendors List','BrowseVendorlist.php');
oCMenu.makeMenu('ITEM25','FileMenu','Currency List','BrowseCurrencylist.php');
oCMenu.makeMenu('ITEM14','FileMenu','Add Role','');
oCMenu.makeMenu('MENU1','','Entries','');
oCMenu.makeMenu('ITEM26','MENU1','Assessment','');
oCMenu.makeMenu('ITEM27','MENU1','Trial Class','');
oCMenu.makeMenu('ITEM28','MENU1','Admission','');
oCMenu.makeMenu('ITEM29','MENU1','Create Schedule','BrowseCreateSchedulelist.php');
oCMenu.makeMenu('ITEM30','MENU1','Invoicing / Payments','');
oCMenu.makeMenu('ITEM1','MENU1','Kit Issuance','');
oCMenu.makeMenu('ITEM31','MENU1','Books','');
oCMenu.makeMenu('ITEM32','MENU1','Attendance','');
oCMenu.makeMenu('ITEM33','MENU1','Progress','');
oCMenu.makeMenu('ITEM34','MENU1','Examinations','BrowseExamFilelist.php');
oCMenu.makeMenu('ITEM35','MENU1','Online Practice','BrowseOnlinelist.php');
oCMenu.makeMenu('MENU2','','Reports','');
oCMenu.makeMenu('MENU3','','Setup','');
oCMenu.makeMenu('MENU4','','Help','');
//Leave this line - it constructs the menu
oCMenu.construct();
