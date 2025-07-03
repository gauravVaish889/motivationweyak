"use strict";(self.webpackChunkwp_event_solution=self.webpackChunkwp_event_solution||[]).push([[332],{15905:(e,t,n)=>{n.d(t,{A:()=>u});var a=n(51609),l=n(75093),r=n(44653),i=n(50300),o=n(69107),c=n(77984),d=n(23495),s=n(4763),m=n(84124);const p=window?.localized_data_obj?.currency_symbol,u=({title:e="Chart",data:t=[],xAxisKey:n="date",yAxisKey:u="revenue"})=>(0,a.createElement)("div",{className:"etn-chart-container",style:{margin:"20px 0"}},(0,a.createElement)("div",{style:{padding:"20px",borderRadius:"8px",border:"1px solid #eee",backgroundColor:"#fff"}},(0,a.createElement)(l.Title,{level:4,style:{marginTop:"20px"}},e),(0,a.createElement)(r.u,{width:"100%",height:300},(0,a.createElement)(i.Q,{data:t,margin:{top:20,right:30,left:20,bottom:5}},(0,a.createElement)("defs",null,(0,a.createElement)("linearGradient",{id:"colorRevenue",x1:"0",y1:"0",x2:"0",y2:"1"},(0,a.createElement)("stop",{offset:"-454.44%",stopColor:"#702CE7",stopOpacity:.4}),(0,a.createElement)("stop",{offset:"76.32%",stopColor:"rgba(107, 46, 229, 0.00)",stopOpacity:0}))),(0,a.createElement)(o.d,{strokeDasharray:"3 3"}),(0,a.createElement)(c.W,{dataKey:n}),(0,a.createElement)(d.h,{tickFormatter:e=>`${p}${e.toLocaleString()}`}),(0,a.createElement)(s.m,{formatter:e=>`${p}${e.toLocaleString()}`}),(0,a.createElement)(m.G,{type:"monotone",dataKey:u,stroke:"#6A2FE4",strokeWidth:3,fill:"url(#colorRevenue)",activeDot:{r:8},animationBegin:0,animationDuration:500,animationEasing:"ease-out"})))))},32649:(e,t,n)=>{n.d(t,{A:()=>p});var a=n(51609),l=n(54725),r=n(27154),i=n(64282),o=n(86087),c=n(52619),d=n(27723),s=n(19549),m=n(92911);function p(e){const{id:t,apiType:n,modalOpen:p,setModalOpen:u}=e,[f,g]=(0,o.useState)(!1);return(0,a.createElement)(s.A,{centered:!0,title:(0,a.createElement)(m.A,{gap:10,className:"eventin-resend-modal-title-container"},(0,a.createElement)(l.DiplomaIcon,null),(0,a.createElement)("span",{className:"eventin-resend-modal-title"},(0,d.__)("Are you sure?","eventin"))),open:p,onOk:async()=>{g(!0);try{let e;"orders"===n&&(e=await i.A.ticketPurchase.resendTicketByOrder(t),(0,c.doAction)("eventin_notification",{type:"success",message:e?.message}),u(!1)),"attendees"===n&&(e=await i.A.attendees.resendTicketByAttendee(t),(0,c.doAction)("eventin_notification",{type:"success",message:e?.message}),u(!1))}catch(e){console.error("Error in ticket resending!",e),(0,c.doAction)("eventin_notification",{type:"error",message:e?.message})}finally{g(!1)}},confirmLoading:f,onCancel:()=>u(!1),okText:"Send",okButtonProps:{type:"default",className:"eventin-resend-ticket-modal-ok-button",style:{height:"32px",fontWeight:600,fontSize:"14px",color:r.PRIMARY_COLOR,border:`1px solid ${r.PRIMARY_COLOR}`}},cancelButtonProps:{className:"eventin-resend-modal-cancel-button",style:{height:"32px"}},cancelText:"Cancel",width:"344px"},(0,a.createElement)("p",{className:"eventin-resend-modal-description"},(0,d.__)(`Are you sure you want to resend the ${"orders"===n?"Invoice":"Ticket"}?`,"eventin")))}},80332:(e,t,n)=>{n.r(t),n.d(t,{default:()=>Ne});var a=n(51609),l=n(86087),r=n(27723),i=n(428),o=n(15905),c=n(54861),d=n(40372),s=n(47152),m=n(16370),p=n(92911),u=n(75063),f=n(51643),g=n(74353),x=n.n(g),_=n(75093),v=n(6836),E=n(64282),y=n(69815),h=n(77278);y.default.div`
	background-color: #ffffff;
	border-radius: 8px;
	padding: 20px;
	padding-top: 0px;
	margin: 20px 0;
`,y.default.div`
	width: 50%;
	@media ( max-width: 768px ) {
		width: 100%;
	}
`;const w=y.default.div`
	display: flex;
	align-items: center;
	justify-content: flex-end;
	gap: 10px;

	@media ( max-width: 992px ) {
		justify-content: flex-start;
	}
	@media ( max-width: 615px ) {
		flex-direction: column;
		align-items: flex-start;
		justify-content: flex-start;
		margin: 10px 0px;

		.ant-radio-button-wrapper {
			height: 30px;
			font-size: 14px;
			line-height: 30px;
		}
	}
`,b=((0,y.default)(h.A)`
	border-radius: 8px;
	box-shadow: 0 1px 5px rgba( 0, 0, 0, 0.05 );
	padding: 20px;
	@media ( max-width: 768px ) {
		padding: 0px;
	}
`,y.default.div`
	font-size: 16px;
	color: #334155;
	font-weight: 400;

	display: flex;
	align-items: center;
	gap: 12px;
`,y.default.div`
	font-size: 32px;
	font-weight: 600;
	margin-left: 52px;
`,(0,y.default)(s.A)`
	margin: 20px 0;
`),{RangePicker:A}=c.A,{useBreakpoint:k}=d.Ay;function D(e){const{dateRange:t,setDateRange:n}=e,[i,o]=(0,l.useState)(""),[c,d]=(0,l.useState)(!0),g=!k()?.md;return(0,l.useEffect)((()=>{(async()=>{try{d(!0);const e=await E.A.user.myProfile();e?.name&&o(e.name)}catch(e){console.log(e)}finally{d(!1)}})()}),[]),(0,a.createElement)(s.A,{gutter:10,align:"center",justify:"space-between"},(0,a.createElement)(m.A,{sm:24,md:8},(0,a.createElement)(_.Title,{level:3,sx:{margin:0}},(0,a.createElement)(p.A,{gap:10,align:"center",justify:"start"},(0,a.createElement)("span",null,(0,r.__)("Hello","eventin")),c?(0,a.createElement)(u.A.Input,{active:!0}):(0,a.createElement)("span",{style:{textTransform:"capitalize"}},i,"!")))),(0,a.createElement)(m.A,{sm:24,md:16},(0,a.createElement)(w,null,(0,a.createElement)(A,{size:"large",placeholder:(0,r.__)("Select Date","eventin"),value:[t.startDate?x()(t?.startDate):null,t.endDate?x()(t?.endDate):null],onChange:e=>{n({startDate:(0,v.dateFormatter)(e?.[0]||void 0),endDate:(0,v.dateFormatter)(e?.[1]||void 0),predefined:null})},format:(0,v.getDateFormat)(),className:"etn-booking-date-range-picker",style:{width:"100%",width:g?"100%":"250px"}}),(0,a.createElement)(f.Ay.Group,{buttonStyle:"solid",size:"large",value:t?.predefined,className:"etn-filter-radio-group",onChange:e=>n({predefined:e.target.value,startDate:void 0,endDate:void 0})},(0,a.createElement)(f.Ay.Button,{value:"all"},(0,r.__)("All Days","eventin")),(0,a.createElement)(f.Ay.Button,{value:30},(0,r.__)("30 Days","eventin")),(0,a.createElement)(f.Ay.Button,{value:7},(0,r.__)("7 Days","eventin")),(0,a.createElement)(f.Ay.Button,{value:0},(0,r.__)("Today","eventin"))))))}var S=n(54725);const z=y.default.div`
	border-radius: 8px;
	background: linear-gradient( 34deg, #6b2ee5 37.99%, #ff4d97 150.96% );
	padding: 24px;
	width: 100%;
	max-width: 400px;
`,F=y.default.div`
	color: #fff;
	font-size: 16px;
	font-weight: 400;
	line-height: 24px;
	display: flex;
	align-items: center;
	gap: 8px;
	word-wrap: break-word;
	white-space: normal;
`,R=y.default.div`
	color: #fff;
	font-size: 32px;
	font-weight: 600;
	line-height: 32px;
	margin-top: 16px;
	margin-left: 32px;
	word-wrap: break-word;
	white-space: normal;
`,T=y.default.div`
	display: flex;
	align-items: center;
	justify-content: center;
	background: rgba( 255, 255, 255, 0.2 );
	border-radius: 50%;
	width: 32px;
	height: 32px;
`,I=({amount:e=0})=>{const{decimals:t,currency_position:n,decimal_separator:l,thousand_separator:i,currency_symbol:o}=window.localized_data_obj;return(0,a.createElement)(z,null,(0,a.createElement)(F,null,(0,a.createElement)(T,null,(0,a.createElement)(S.RevenueIcon,null)),(0,r.__)("Total Revenue","eventin")),(0,a.createElement)(R,null,(0,v.formatSymbolDecimalsPrice)(e,t,n,l,i,o)))},B=y.default.div`
	border-radius: 8px;
	background: #ffffff;
	padding: 24px;
	width: 100%;
	max-width: 400px;
`,O=y.default.div`
	color: #334155;
	font-size: 16px;
	font-weight: 400;
	line-height: 24px;
	display: flex;
	align-items: center;
	gap: 8px;
	word-wrap: break-word;
	white-space: normal;
`,C=y.default.div`
	color: #020617;
	font-size: 32px;
	font-weight: 600;
	line-height: 32px;
	margin-top: 16px;
	margin-left: 32px;
	word-wrap: break-word;
	white-space: normal;
`,N=y.default.div`
	display: flex;
	align-items: center;
	justify-content: center;
	background: rgba( 255, 255, 255, 0.2 );
	border-radius: 50%;
	width: 32px;
	height: 32px;
`,j=({title:e,amount:t,icon:n})=>{const l=(e=>e>=1e12?(e/1e12).toFixed(2)+"T":e>=1e9?(e/1e9).toFixed(2)+"B":e>=1e6?(e/1e6).toFixed(2)+"M":e.toLocaleString("en-US"))(Number(t));return(0,a.createElement)(B,null,(0,a.createElement)(O,null,(0,a.createElement)(N,null,n),e),(0,a.createElement)(C,null,l))},P=y.default.div`
	padding: 24px;
	width: 100%;
	max-width: 400px;
	height: 128px;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	border-radius: 8px;
	box-shadow: 0 1px 5px rgba( 0, 0, 0, 0.05 );
	background-color: #ffffff;
`,Y=y.default.div`
	display: flex;
	align-items: center;
	gap: 8px;
`,M=y.default.div`
	margin-left: 32px;
`,$=()=>(0,a.createElement)(P,null,(0,a.createElement)(Y,null,(0,a.createElement)(u.A.Avatar,{size:32,active:!0}),(0,a.createElement)(u.A.Input,{active:!0,size:"small",style:{width:120}})),(0,a.createElement)(M,null,(0,a.createElement)(u.A.Input,{active:!0,size:"large",style:{width:180}}))),W=e=>{const{data:t,loading:n}=e,{totalEvents:l,totalSpeakers:i,totalAttendee:o,totalRevenue:c}=t,d=[{title:(0,r.__)("Total Events","eventin"),amount:l||0,icon:(0,a.createElement)(S.TotalEventsIcon,null)},{title:(0,r.__)("Total Attendees","eventin"),amount:o||0,icon:(0,a.createElement)(S.TotalParticipantsIcon,null)},{title:(0,r.__)("Total Speakers","eventin"),amount:i||0,icon:(0,a.createElement)(S.TotalSpeakersIcon,null)}];return(0,a.createElement)(b,{gutter:[16,16],justify:"center",align:"middle"},(0,a.createElement)(m.A,{xs:24,sm:12,md:6},n?(0,a.createElement)($,{active:!0}):(0,a.createElement)(I,{amount:c})),d.map(((e,t)=>(0,a.createElement)(m.A,{key:t,xs:24,sm:12,md:6},n?(0,a.createElement)($,{active:!0}):(0,a.createElement)(j,{title:e.title,amount:e.amount,icon:e.icon})))))};var L=n(56427),K=n(79664),V=n(18062),G=n(27154);function H(e){const{title:t}=e,n=y.default.div`
		@media ( max-width: 360px ) {
			display: none;
		}
	`;return(0,a.createElement)(L.Fill,{name:G.PRIMARY_HEADER_NAME},(0,a.createElement)(p.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(V.A,{title:t}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center"}},(0,a.createElement)(p.A,{gap:12},(0,a.createElement)(n,null,(0,a.createElement)(K.A,null))))))}var q=n(51212),Q=n(16784),U=n(7638);const X=(0,y.default)(p.A)`
	background-color: #fff;
	padding: 12px 24px;
`;var J=n(84976),Z=n(18537),ee=n(905),te=n(90070),ne=n(32099),ae=n(17437),le=n(11721),re=n(29491),ie=n(47143),oe=n(52619),ce=n(80734),de=n(10962),se=n(32649);const me=(0,ie.withSelect)((e=>{const t=e("eventin/global");return{settings:t.getSettings(),isSettingsLoading:t.isResolving("getSettings")}})),pe=(0,ie.withDispatch)((e=>({setRevalidateData:e("eventin/global").setRevalidatePurchaseReportList}))),ue=(0,re.compose)([me,pe])((function(e){const{setRevalidateData:t,record:n,isSettingsLoading:i}=e,[o,c]=(0,l.useState)(!1),d=async()=>{try{await E.A.purchaseReport.deleteOrder(n.id),t(!0),(0,oe.doAction)("eventin_notification",{type:"success",message:(0,r.__)("Successfully deleted the event!","eventin")})}catch(e){console.error("Error deleting the purchase report",e),(0,oe.doAction)("eventin_notification",{type:"error",message:(0,r.__)("Failed to delete the event!","eventin")})}},s=[{label:(0,r.__)("Delete","eventin"),key:"7",icon:(0,a.createElement)(S.DeleteOutlined,{width:"16",height:"16"}),className:"delete-event",onClick:()=>{(0,ce.A)({title:(0,r.__)("Are you sure?","eventin"),content:(0,r.__)("Are you sure you want to delete this booking?","eventin"),onOk:d})}}],m=(0,oe.applyFilters)("eventin-pro-booking-list-action-items",s,c,n);return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(ae.mL,{styles:de.S}),(0,a.createElement)(le.A,{menu:{items:m},trigger:["click"],placement:"bottomRight",overlayClassName:"action-dropdown"},(0,a.createElement)(U.Ay,{variant:U.Vt,disabled:i},(0,a.createElement)(S.MoreIconOutlined,{width:"16",height:"16"}))),(0,a.createElement)(se.A,{id:n.id,modalOpen:o,setModalOpen:c,apiType:"orders"}))}));var fe=n(500),ge=n(48842),xe=n(71524);const _e=y.default.div`
	padding: 10px 20px;
	background-color: #fff;
`,ve=e=>{const{label:t,value:n,labelSx:l={},valueSx:r={}}=e;return(0,a.createElement)("div",{style:{margin:"10px 0"}},(0,a.createElement)("div",null,(0,a.createElement)(ge.A,{sx:{fontSize:"16px",fontWeight:600,color:"#334155",...l}},t)),(0,a.createElement)("div",null,(0,a.createElement)(ge.A,{sx:{fontSize:"16px",fontWeight:400,color:"#334155",...r}},n)))},Ee=(0,y.default)(xe.A)`
	border-radius: 20px;
	font-size: 12px;
	font-weight: 600;
	padding: 4px 13px;
	min-width: 80px;
	text-align: center;
	margin: 0px 10px;
`,{useBreakpoint:ye}=d.Ay,he={completed:{label:(0,r.__)("Completed","eventin"),color:"success"},failed:{label:(0,r.__)("Failed","eventin"),color:"error"}},we={stripe:"Stripe",wc:"WooCommerce",paypal:"PayPal"};function be(e){const{modalOpen:t,setModalOpen:n,data:l}=e,i=he[l?.status]?.color||"error",o=he[l?.status]?.label||"Failed",c=!ye()?.md,{currency_position:d,decimals:u,decimal_separator:f,thousand_separator:g,currency_symbol:x}=window?.localized_data_obj||{},_=[{title:(0,r.__)("No.","eventin"),dataIndex:"id",key:"id"},{title:(0,r.__)("Name","eventin"),dataIndex:"etn_name",key:"name"},{title:(0,r.__)("Ticket","eventin"),key:"ticketType",render:(e,t)=>(0,a.createElement)(ge.A,null,t?.attendee_seat||t?.ticket_name)},{title:(0,r.__)("Actions","eventin"),key:"actions",type:"actions",width:"10%",align:"center",render:(e,t)=>(0,a.createElement)(ne.A,{title:(0,r.__)("View Details and Download Ticket","eventin")},(0,a.createElement)(U.Ay,{variant:U.Vt,onClick:()=>(e=>{let t=`${localized_data_obj.site_url}/etn-attendee?etn_action=download_ticket&attendee_id=${e?.id}&etn_info_edit_token=${e?.etn_info_edit_token}`;window.open(t,"_blank")})(t),icon:(0,a.createElement)(S.EyeOutlinedIcon,null),sx:{height:"32px",padding:"4px",width:"32px !important"}}))}];return(0,a.createElement)(fe.A,{centered:!0,title:(0,r.__)("Booking ID","eventin")+" - "+l?.id,open:t,okText:(0,r.__)("Close","eventin"),onOk:()=>n(!1),onCancel:()=>n(!1),width:c?400:700,footer:null,styles:{body:{height:"500px",overflowY:"auto"}},style:{marginTop:"20px"}},(0,a.createElement)(_e,null,(0,a.createElement)(p.A,{justify:"space-between",align:"center",style:{borderBottom:"1px solid #F0F0F0",paddingBottom:"15px"}},(0,a.createElement)("div",null,(0,a.createElement)(ge.A,{sx:{fontWeight:600,fontSize:"18px",color:"#334155"}},(0,r.__)("Billing Information","eventin")),(0,a.createElement)(Ee,{bordered:!1,color:i},(0,a.createElement)("span",null,o))),(0,a.createElement)(ge.A,{sx:{fontWeight:600,fontSize:"18px",color:"#334155"}},(0,ee.A)(Number(l?.total_price),u,d,f,g,x))),(0,a.createElement)(s.A,{align:"middle",style:{margin:"10px 0"}},(0,a.createElement)(m.A,{xs:24,md:12},(0,a.createElement)(ve,{label:(0,r.__)("Name","eventin"),value:`${l?.customer_fname} ${l?.customer_lname}`||"-"}),(0,a.createElement)(ve,{label:(0,r.__)("Email","eventin"),value:l?.customer_email||"-"})),(0,a.createElement)(m.A,{xs:24,md:12},(0,a.createElement)(ve,{label:(0,r.__)("Received On","eventin"),value:(0,v.getWordpressFormattedDateTime)(l?.date_time)||"-"}),(0,a.createElement)(ve,{label:(0,r.__)("Payment Gateway","eventin"),value:we[l?.payment_method]||"-"})),(0,a.createElement)(m.A,{xs:24},(0,a.createElement)(ve,{label:(0,r.__)("Event","eventin"),value:l?.event_name||"-"}))),l?.attendees?.length>0?(0,a.createElement)(a.Fragment,null,(0,a.createElement)(p.A,{justify:"space-between",align:"center",style:{borderBottom:"1px solid #F0F0F0",paddingBottom:"15px"}},(0,a.createElement)(ge.A,{sx:{fontWeight:600,fontSize:"18px",color:"#334155"}},(0,r.__)("Attendee List","eventin"))),(0,a.createElement)(Q.A,{columns:_,dataSource:l?.attendees,pagination:!1,rowKey:"id",size:"small",style:{width:"100%"}})):l?.ticket_items?.length>0&&(0,a.createElement)(a.Fragment,null,(0,a.createElement)(p.A,{justify:"space-between",align:"center",style:{borderBottom:"1px solid #F0F0F0",paddingBottom:"15px"}},(0,a.createElement)(ge.A,{sx:{fontWeight:600,fontSize:"18px",color:"#334155"}},(0,r.__)("Ticket Info","eventin"))),l?.ticket_items?.map(((e,t)=>e?.etn_ticket_qty>0&&e?.seats?e?.seats?.map(((e,t)=>(0,a.createElement)(ge.A,{key:t}," ",e,(0,a.createElement)("br",null)))):(0,a.createElement)(React.Fragment,{key:t},(0,a.createElement)(ve,{label:"",value:e?.etn_ticket_name+" X "+e?.etn_ticket_qty||"-"})))))))}function Ae(e){const{record:t}=e,[n,r]=(0,l.useState)(!1);return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(U.Ay,{variant:U.Vt,onClick:()=>r(!0)},(0,a.createElement)(S.EyeOutlinedIcon,{width:"16",height:"16"})),(0,a.createElement)(be,{modalOpen:n,setModalOpen:r,data:t}))}function ke(e){const{record:t}=e;return(0,a.createElement)(te.A,{size:"small",className:"event-actions"},(0,a.createElement)(ne.A,{title:(0,r.__)("View Details","eventin")},(0,a.createElement)(Ae,{record:t})," "),(0,a.createElement)(ne.A,{title:(0,r.__)("More Actions","eventin")},(0,a.createElement)(ue,{record:t})," "))}function De(e){const{text:t,record:n}=e,l=(0,v.getWordpressFormattedDate)(n?.start_date)+`, ${(0,v.getWordpressFormattedTime)(n?.start_time)} `;return(0,a.createElement)(a.Fragment,null,(0,a.createElement)("span",{className:"event-title"},t),(0,a.createElement)("p",{className:"event-date-time"},n.start_date&&n.start_time&&(0,a.createElement)("span",null,l)))}function Se(e){const{status:t}=e,n={pending:{color:"warning",text:"Pending"},processing:{color:"processing",text:"Processing"},hold:{color:"default",text:"Hold"},completed:{color:"success",text:"Completed"},refunded:{color:"default",text:"Refunded"},failed:{color:"error",text:"Failed"}};return(0,a.createElement)(xe.A,{bordered:!1,color:n[t]?.color||"default"},n[t]?.text||t)}const{currency_position:ze,decimals:Fe,decimal_separator:Re,thousand_separator:Te,currency_symbol:Ie}=window?.localized_data_obj||{},Be={wc:"WooCommerce",stripe:"Stripe",paypal:"PayPal"},Oe=[{title:(0,r.__)("ID & Date","eventin"),dataIndex:"id",key:"id",width:"12%",render:(e,t)=>(0,a.createElement)(a.Fragment,null,(0,a.createElement)(De,{text:`#${(0,Z.decodeEntities)(e)}`,record:t}),(0,a.createElement)("span",{className:"event-date-time"}," ",(0,v.getWordpressFormattedDateTime)(t?.date_time)))},{title:(0,r.__)("Name","eventin"),key:"name",dataIndex:"name",width:"18%",render:(e,t)=>(0,a.createElement)("span",null,`${t?.customer_fname} ${t?.customer_lname}`)},{title:(0,r.__)("Email","eventin"),dataIndex:"customer_email",key:"email",width:"20%",render:e=>(0,a.createElement)("span",null,e)},{title:(0,r.__)("Tickets","eventin"),dataIndex:"ticket_items",key:"author",width:"10%",render:(e,t)=>(0,a.createElement)("span",null,`${t?.total_ticket}`)},{title:(0,r.__)("Payment","eventin"),dataIndex:"payment_method",key:"payment_method",width:"10%",render:e=>(0,a.createElement)("span",null,Be[e]||"-")},{title:(0,r.__)("Amount","eventin"),dataIndex:"total_price",key:"total_price",width:"10%",render:e=>(0,a.createElement)("span",null,(0,ee.A)(Number(e),Fe,ze,Re,Te,Ie))},{title:(0,r.__)("Status","eventin"),dataIndex:"status",key:"status",width:"12%",render:e=>(0,a.createElement)(Se,{status:e})},{title:(0,r.__)("Action","eventin"),key:"action",width:"10%",render:(e,t)=>(0,a.createElement)(ke,{record:t})}],Ce=function(e){const{loading:t,dataSource:n}=e;return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(X,{justify:"space-between",align:"center",gap:10,wrap:"wrap",className:"eventin-dashboard-booking-table-title-container"},(0,a.createElement)(_.Title,{level:4,style:{marginTop:"20px"}},(0,r.__)("Recent Bookings","eventin")," "),(0,a.createElement)(J.Link,{to:"/purchase-report"},(0,a.createElement)(U.Ay,{variant:U.zB,style:{width:"100%"}},(0,r.__)("View All","eventin")))),(0,a.createElement)(Q.A,{loading:t,columns:Oe,dataSource:n,scroll:{x:1e3},sticky:{offsetHeader:100},pagination:!1}))},Ne=()=>{const[e,t]=(0,l.useState)(!0),[n,c]=(0,l.useState)(!0),[d,s]=(0,l.useState)(null),[m,p]=(0,l.useState)(null),[u,f]=(0,l.useState)({startDate:void 0,endDate:void 0,predefined:"all"});return(0,l.useEffect)((()=>{(async()=>{try{t(!0);const e=await E.A.reports.getReports((()=>{if("all"===u?.predefined)return{start_date:void 0,end_date:void 0};if(0===u?.predefined)return{start_date:x()().format("YYYY-MM-DD"),end_date:x()().format("YYYY-MM-DD")};if(!u?.predefined)return{start_date:u?.startDate,end_date:u?.endDate};const e=x()().format("YYYY-MM-DD");return{start_date:x()().subtract(u?.predefined,"day").format("YYYY-MM-DD"),end_date:e}})()),n=await(e?.json());s(n)}catch(e){console.log(e)}finally{t(!1)}})()}),[u]),(0,l.useEffect)((()=>{(async()=>{try{c(!0);const e=await E.A.purchaseReport.ordersByEvent({per_page:10,paged:1}),t=await(e?.json());p(t)}catch(e){console.log(e)}finally{c(!1)}})()}),[]),(0,l.useEffect)((()=>{document.body?.classList?.remove("folded")}),[]),(0,a.createElement)("div",null,(0,a.createElement)(H,{title:(0,r.__)("Dashboard","eventin")}),(0,a.createElement)(q.f,null,(0,a.createElement)(D,{dateRange:u,setDateRange:f}),(0,a.createElement)(W,{loading:e,data:{totalEvents:d?.event,totalSpeakers:d?.speaker,totalAttendee:d?.attendee,totalRevenue:d?.revenue}}),(0,a.createElement)(i.A,{spinning:e},(0,a.createElement)(o.A,{title:(0,r.__)("Booking Performance","eventin"),data:d?.date_reports||[],xAxisKey:"date",yAxisKey:"revenue"})),(0,a.createElement)(Ce,{loading:n,dataSource:m})))}},51212:(e,t,n)=>{n.d(t,{f:()=>a});const a=n(69815).default.div`
	background-color: #f4f6fa;
	padding: 12px 32px;
	min-height: 100vh;

	.ant-table-wrapper {
		padding: 20px;
		background-color: #fff;
	}

	.event-list-wrapper {
		box-shadow: 0 2px 8px 0 rgba( 0, 0, 0, 0.15 );
		border-radius: 0 0 4px 4px;
	}

	.ant-table-wrapper {
		border-radius: 0 0 4px 4px;
	}

	.ant-table-thead {
		> tr {
			> th {
				background-color: #f1f5f9;
				padding-top: 10px;
				font-weight: 600;
				color: #1e293b;
				font-size: 16px;
				&:before {
					display: none;
				}
			}
		}
	}

	tr {
		&:hover {
			background-color: #f8fafc !important;
		}
	}

	.event-title {
		color: #020617;
		font-size: 18px;
		font-weight: 600;
		line-height: 26px;
		display: inline-flex;
		margin-bottom: 6px;
	}

	.event-location,
	.event-date-time {
		color: #334155;
		font-weight: 400;
		margin: 0;
		line-height: 1.4;
		font-size: 14px;
	}
	.event-date-time {
		display: flex;
		align-items: center;
		gap: 4px;
	}

	.event-location {
		margin-bottom: 4px;
	}

	.event-actions {
		.ant-btn {
			padding: 0;
			width: 28px;
			height: 28px;
			line-height: 1;
			display: flex;
			justify-content: center;
			align-items: center;
			border-color: #94a3b8;
			color: #94a3b8;
			background-color: #fff;
		}
	}

	.ant-tag {
		border-radius: 20px;
		font-size: 12px;
		font-weight: 400;
		padding: 4px 13px;
		min-width: 80px;
		text-align: center;
	}

	.ant-tag.event-category {
		background-color: transparent;
		font-size: 16px;
		color: #334155;
		font-wight: 400;
		padding: 0;
		text-align: left;
	}

	.author {
		font-size: 16px;
		color: #334155;
		font-wight: 400;
		text-transform: capitalize;
	}
	.recurring-badge {
		background-color: #1890ff1a;
		color: #1890ff;
		font-size: 12px;
		padding: 5px 12px;
		border-radius: 50px;
		font-weight: 600;
		margin-inline: 10px;
	}
`}}]);