"use strict";(self.webpackChunkwp_event_solution=self.webpackChunkwp_event_solution||[]).push([[407,981],{57770:(e,t,n)=>{n.d(t,{A:()=>r});var a=n(18537);function r(e,t){if(Array.isArray(e))return JSON.parse(JSON.stringify(e)).map((e=>(e[t]=(0,a.decodeEntities)(e[t]),e)))}},61149:(e,t,n)=>{n.d(t,{O:()=>o,f:()=>r});var a=n(69815);const r=a.default.div`
	background-color: #f4f6fa;
	padding: 12px 32px;
	min-height: 100vh;

	.ant-table-wrapper {
		padding: 20px;
		background-color: #fff;
	}

	.event-categories-wrapper {
		box-shadow: 0 2px 8px 0 rgba( 0, 0, 0, 0.15 );
		border-radius: 0 0 4px 4px;
	}

	.ant-table-wrapper {
		border-radius: 0 0 4px 4px;
	}

	.ant-table-thead {
		> tr {
			> th {
				background-color: transparent;
				padding-top: 10px;
				font-weight: 500;
				color: #747474;
				&:before {
					display: none;
				}
			}
		}
	}

	.event-title {
		color: #181818;
		font-size: 1rem;
		font-weight: 400;
		line-height: 24px;
		display: inline-flex;
		margin-bottom: 6px;
	}

	.event-location,
	.event-date-time {
		color: #858585;
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
			border-color: #c9c9c9;
			color: #c9c9c9;
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
		font-size: 1rem;
		color: #181818;
		padding: 0;
		text-align: left;
	}

	.author {
		color: #181818;
		font-size: 1rem;
		text-transform: capitalize;
	}
`,o=a.default.div`
	padding: 18px 24px;
	background: #fff;
	border-radius: 4px 4px 0 0;
	border-bottom: 1px solid #ddd;

	.ant-form-item {
		margin-bottom: 0;
	}
	.ant-select-single {
		height: 36px;
		width: 120px !important;
	}

	.ant-picker {
		height: 36px;
	}
	.event-filter-by-name {
		height: 36px;
		border: 1px solid #ddd;
		max-width: 220px;

		input.ant-input {
			min-height: 32px !important;
		}
	}
`},71819:(e,t,n)=>{n.d(t,{A:()=>b});var a=n(51609),r=n(29491),o=n(47143),i=n(86087),l=n(27723),s=n(47152),c=n(16370),p=n(60742),d=n(36492),m=n(92911),u=n(32099),g=n(38181),v=n(54725),f=n(7638),h=n(3606),_=n(13444),x=n(16032),E=n(10012),A=n(91807),y=n(23985);const k=(0,o.withSelect)((e=>{const t=e("eventin/global");return{speakerCategories:t.getSpeakerCategories(),isLoading:t.isResolving("getSpeakerCategories")}})),b=(0,r.compose)(k)((e=>{const{form:t,speakerCategories:n}=e,[r,o]=(0,i.useState)(!1);return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(s.A,{gutter:[16,0]},(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(E.ks,{label:(0,l.__)("Full Name","eventin"),name:"name",rules:[{required:!0,message:(0,l.__)("Speaker name is required!","eventin")}],required:!0,placeholder:(0,l.__)("Name of Speaker","eventin"),size:"large"})),(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(p.A.Item,{label:(0,l.__)("Role","eventin"),name:"category",style:{width:"100%"},rules:[{required:!0,message:(0,l.__)("You must choose a Roll","eventin")}]},(0,a.createElement)(d.A,{options:C,placeholder:(0,l.__)("Select Speaker Role","eventin"),size:"large",mode:"multiple",showSearch:!1}))),(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(E.ks,{label:(0,l.__)("Job Title","eventin"),name:"designation",placeholder:(0,l.__)("Enter Job Title","eventin"),size:"large"})),(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(p.A.Item,{label:(0,l.__)("Speaker Group","eventin"),name:"speaker_group",style:{width:"100%"}},(0,a.createElement)(_.A,{placeholder:(0,l.__)("Select a Group to add speakers","eventin"),options:n,fieldNames:{value:"id",label:"name"},mode:"multiple",maxTagCount:"responsive"},(0,a.createElement)(f.yl,{onClick:()=>o(!0)},(0,l.__)("Add new group","eventin"))))),(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(E.ks,{label:(0,l.__)("Email Address","eventin"),name:"email",required:!0,rules:[{required:!0,message:(0,l.__)("Speaker email is required!","eventin")}],placeholder:(0,l.__)("Email address of Speaker","eventin"),size:"large"})),(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(E.ks,{label:(0,l.__)("Company Name","eventin"),name:"company_name",placeholder:(0,l.__)("Enter Company Name","eventin"),size:"large"})),(0,a.createElement)(c.A,{xs:24},(0,a.createElement)(E.ks,{label:(0,l.__)("Company URL","eventin"),name:"company_url",placeholder:(0,l.__)("Enter Company URL","eventin"),size:"large",rules:[{type:"url",message:(0,l.__)("Please enter a valid URL!","eventin")}]})),(0,a.createElement)(c.A,{xs:24,md:24},(0,a.createElement)(h.A,{name:"summary",label:(0,l.__)("Speaker Bio","eventin"),form:t,sx:{height:"150px"}}))),(0,a.createElement)(s.A,{gutter:[16,0]},(0,a.createElement)(c.A,{xs:24,md:8},(0,a.createElement)(p.A.Item,{label:(0,l.__)("Speaker Photo","eventin"),name:"image",tooltip:(0,l.__)("Upload speaker photo","eventin")},(0,a.createElement)(A.ng,{form:t,name:"image",buttonText:(0,l.__)("Upload Photo","eventin")}))),(0,a.createElement)(c.A,{xs:24,md:8},(0,a.createElement)(p.A.Item,{label:(0,l.__)("Company logo","eventin"),name:"company_logo",tooltip:(0,l.__)("Upload your company logo","eventin")},(0,a.createElement)(A.ng,{form:t,name:"company_logo",buttonText:(0,l.__)("Upload Logo","eventin")})))),(0,a.createElement)(s.A,{gutter:[16,0],align:"middle"},(0,a.createElement)(c.A,{xs:24},(0,a.createElement)("div",null,(0,a.createElement)(m.A,{align:"center"},(0,a.createElement)("p",{style:{margin:"10px 0px",fontSize:"16px",fontWeight:600,color:"#444444"}},(0,l.__)("Social","eventin")),(0,a.createElement)(u.A,{title:(0,l.__)("Promote your event by adding links to your social media profiles.","eventin")},(0,a.createElement)("span",{style:{marginLeft:"7px"}},(0,a.createElement)(v.InfoCircleOutlined,{width:15,height:15})))))),(0,a.createElement)(c.A,{xs:24},(0,a.createElement)(x.A,{form:t,name:"social",label:(0,l.__)("Social Links","eventin")}))),(0,a.createElement)(s.A,null,(0,a.createElement)(c.A,{xs:24},(0,a.createElement)(p.A.Item,{name:"hide_user",valuePropName:"checked"},(0,a.createElement)(g.A,{style:{fontWeight:500}},(0,l.__)("Hide From Users","eventin"))))),(0,a.createElement)(y.A,{modalOpen:r,setModalOpen:o}))})),C=[{value:"speaker",label:(0,l.__)("Speaker","eventin")},{value:"organizer",label:(0,l.__)("Organizer","eventin")}]},65407:(e,t,n)=>{n.r(t),n.d(t,{default:()=>N});var a=n(51609),r=n(56427),o=n(29491),i=n(47143),l=n(86087),s=n(27723),c=n(52619),p=n(69815),d=n(60742),m=n(92911),u=n(47152),g=n(16370),v=n(428),f=n(74353),h=n.n(f),_=n(47767),x=n(54725),E=n(7638),A=n(79664),y=n(18062),k=(n(10012),n(57237),n(27154)),b=n(6836),C=n(64282),w=n(71819);const S=p.default.div`
	background-color: #ffffff;
	border: 1px solid #e1e4e9;
	border-radius: 8px;
	padding: 20px 40px;
	margin-top: 40px;
`,G=(0,i.withDispatch)((e=>{const t=e("eventin/global");return{invalidateSpeakerList:()=>t.invalidateResolution("getTotalSpeakers")}})),N=(0,o.compose)(G)((function(e){const{invalidateSpeakerList:t}=e,[n]=d.A.useForm(),{id:o}=(0,_.useParams)(),i=(0,_.useNavigate)(),p=!!o,[f,G]=(0,l.useState)(!1);return(0,l.useEffect)((()=>{p&&!f&&(G(!0),C.A.speakers.singleSpeaker(o).then((e=>{const t={...e,social:Array.isArray(e?.social)&&e?.social?.every((e=>Array.isArray(e)))?[{}]:e?.social,date:h()(e.date)};n.setFieldsValue(t)})).finally((()=>{G(!1)})))}),[]),(0,a.createElement)("div",{style:{backgroundColor:"#F3F5F7",marginTop:"-20px",paddingBottom:"20px",minHeight:"calc( 100vh - 60px )"}},(0,a.createElement)(r.Fill,{name:k.PRIMARY_HEADER_NAME},(0,a.createElement)(m.A,{justify:"space-between",align:"center"},(0,a.createElement)(m.A,{align:"center",gap:16},(0,a.createElement)(E.Ay,{variant:E.Vt,icon:(0,a.createElement)(x.AngleLeftIcon,null),sx:{height:"36px",width:"36px",backgroundColor:"#fafafa",borderColor:"transparent",lineHeight:"1"},onClick:()=>{i("/speakers")}}),(0,a.createElement)(y.A,{title:p?(0,s.__)("Update Speaker / Organizer","eventin"):(0,s.__)("Add Speaker / Organizer","eventin")})),(0,a.createElement)(A.A,null))),(0,a.createElement)(u.A,{gutter:[16,10],justify:"center",style:{margin:"20px 0px"},className:"eventin-create-speaker-form-wrapper"},(0,a.createElement)(g.A,{xs:22,sm:20,xl:14,className:"eventin-create-speaker-form-container"},(0,a.createElement)(S,null,f&&(0,a.createElement)(m.A,{justify:"center",align:"center",style:{minHeight:"320px"}},(0,a.createElement)(v.A,null)),!f&&(0,a.createElement)(d.A,{layout:"vertical",form:n,scrollToFirstError:!0,size:"large",onFinish:async()=>{G(!0);try{await n.validateFields();const e=n.getFieldsValue(!0);if(e.date=(0,b.dateFormatter)(e.date),window.scrollTo(0,0),p){const n=await C.A.speakers.updateSpeaker(o,e);if(!n?.id)throw new Error((0,s.__)("Couldn't edit speaker properly!","eventin"));t(),i("/speakers"),(0,c.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully updated the speaker!","eventin")})}else{const n=await C.A.speakers.createSpeaker(e);if(!n?.id)throw new Error((0,s.__)("Couldn't edit speaker properly!","eventin"));t(),i("/speakers"),(0,c.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully created the speaker!","eventin")})}}catch(e){(0,c.doAction)("eventin_notification",{type:"error",message:(0,s.__)(`Failed to ${p?"update":"create"} the speaker!`,"eventin"),description:e?.message||""})}finally{G(!1)}}},(0,a.createElement)(w.A,{form:n}),(0,a.createElement)(m.A,{gap:16,style:{marginTop:"20px"}},(0,a.createElement)(E.Ay,{variant:E.zB,loading:f,htmlType:"submit"},p?(0,s.__)("Update Speaker","eventin"):(0,s.__)("Create Speaker","eventin")),(0,a.createElement)(E.Ay,{variant:E.Rm,htmlType:"reset",onClick:()=>i("/speakers")},(0,s.__)("Close","eventin"))))))))}))},96031:(e,t,n)=>{n.d(t,{A:()=>h});var a=n(51609),r=n(56427),o=n(27723),i=n(92911),l=n(52741),s=n(11721),c=n(47767),p=n(69815),d=n(7638),m=n(79664),u=n(18062),g=n(27154),v=n(54725);const f=p.default.div`
	@media ( max-width: 360px ) {
		display: none;
		border: 1px solid red;
	}
`;function h(e){const{title:t,buttonText:n,onClickCallback:p}=e,h=(0,c.useNavigate)(),{pathname:_}=(0,c.useLocation)(),x=["/speakers"!==_&&{key:"0",label:(0,o.__)("Speaker List","eventin"),icon:(0,a.createElement)(v.EventListIcon,{width:20,height:20}),onClick:()=>{h("/speakers")}},"/speakers/group"!==_&&{key:"2",label:(0,o.__)("Speaker Groups","eventin"),icon:(0,a.createElement)(v.CategoriesIcon,null),onClick:()=>{h("/speakers/group")}}];return(0,a.createElement)(r.Fill,{name:g.PRIMARY_HEADER_NAME},(0,a.createElement)(i.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(u.A,{title:t}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center"}},(0,a.createElement)(d.Ay,{variant:d.zB,htmlType:"button",onClick:p,sx:{display:"flex",alignItems:"center",fontSize:"16px",fontWeight:600,borderRadius:"6px",height:"44px"}},(0,a.createElement)(v.PlusOutlined,null),n),(0,a.createElement)(l.A,{type:"vertical",style:{height:"44px",marginInline:"12px",top:"0"}}),(0,a.createElement)(i.A,{gap:12},(0,a.createElement)(s.A,{menu:{items:x},trigger:["click"],placement:"bottomRight",overlayClassName:"action-dropdown"},(0,a.createElement)(d.Ay,{variant:d.Vt,sx:{borderColor:"#E5E5E5",color:"#8C8C8C",height:"44px",lineHeight:"1"}},(0,a.createElement)(v.MoreIconOutlined,null))),(0,a.createElement)(f,null,(0,a.createElement)(m.A,null))))))}},1806:(e,t,n)=>{n.d(t,{A:()=>g});var a=n(51609),r=n(19549),o=n(29491),i=n(47143),l=n(52619),s=n(27723),c=n(54725),p=n(7638),d=n(64282);const{confirm:m}=r.A,u=(0,i.withDispatch)((e=>{const t=e("eventin/global");return{refreshGroupList:()=>t.invalidateResolution("getSpeakerCategories")}})),g=(0,o.compose)(u)((function(e){const{refreshGroupList:t,record:n}=e;return(0,a.createElement)(p.Ay,{variant:p.Vt,onClick:()=>{m({title:(0,s.__)("Are you sure?","eventin"),icon:(0,a.createElement)(c.DeleteOutlinedEmpty,null),content:(0,s.__)("Are you sure you want to delete this group?","eventin"),okText:(0,s.__)("Delete","eventin"),okButtonProps:{type:"primary",danger:!0,classNames:"delete-btn"},centered:!0,onOk:async()=>{try{await d.A.speakerCategories.deleteCategory(n.id),t(),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully deleted the group!","eventin")})}catch(e){console.error("Error deleting group!",e),(0,l.doAction)("eventin_notification",{type:"error",message:(0,s.__)("Failed to delete the group!","eventin")})}},onCancel(){console.log("Cancel")}})}},(0,a.createElement)(c.DeleteOutlined,{width:"16",height:"16"}))}))},43647:(e,t,n)=>{n.d(t,{A:()=>s});var a=n(51609),r=n(86087),o=n(54725),i=n(7638),l=n(65981);function s(e){const{record:t}=e,{setGroupsData:n}=(0,r.useContext)(l.SpeakersGroupContext);return(0,a.createElement)(i.Ay,{variant:i.Vt,onClick:()=>{n((e=>({...e,editData:t,isModalOpen:!0})))}},(0,a.createElement)(o.EditOutlined,{width:"16",height:"16"}))}},54711:(e,t,n)=>{n.d(t,{A:()=>l});var a=n(51609),r=n(90070),o=n(1806),i=n(43647);function l(e){const{record:t}=e;return(0,a.createElement)(r.A,{size:"small",className:"event-actions"},(0,a.createElement)(i.A,{record:t}),(0,a.createElement)(o.A,{record:t}))}},51837:(e,t,n)=>{n.d(t,{A:()=>l});var a=n(51609),r=n(27723),o=n(54711),i=n(84601);window.innerWidth;const l=[{title:(0,r.__)("ID","eventin"),dataIndex:"id",key:"id",defaultSortOrder:"ascend",sorter:(e,t)=>e.id-t.id},{title:(0,r.__)("Group","eventin"),dataIndex:"name",key:"name",width:"30%",render:(e,t)=>(0,a.createElement)(i.A,{text:e,record:t})},{title:(0,r.__)("Count","eventin"),dataIndex:"count",key:"count",render:e=>(0,a.createElement)("span",{className:"author"},e)},{title:(0,r.__)("Action","eventin"),key:"action",width:120,render:(e,t)=>(0,a.createElement)(o.A,{record:t})}]},59320:(e,t,n)=>{n.d(t,{A:()=>g});var a=n(51609),r=n(92911),o=n(79888),i=n(86087),l=n(27723),s=n(54725),c=n(79351),p=n(62215),d=n(61149),m=n(64282),u=n(65981);const g=e=>{const{selectedGroups:t,setSelectedGroups:n}=e,{setGroupsData:g}=(0,i.useContext)(u.SpeakersGroupContext),v=!!t?.length;return(0,a.createElement)(d.O,{className:"filter-wrapper"},(0,a.createElement)(r.A,{justify:v?"space-between":"flex-end",align:"center"},(0,a.createElement)(r.A,{justify:"start",align:"center",gap:8},v&&(0,a.createElement)(c.A,{refreshListName:"getSpeakerCategories",selectedCount:t?.length,callbackFunction:async()=>{const e=(0,p.A)(t);await m.A.speakerCategories.deleteCategory(e),n([])},setSelectedRows:n})),!v&&(0,a.createElement)(o.A,{className:"event-filter-by-name",placeholder:(0,l.__)("Search by group name","eventin"),size:"default",prefix:(0,a.createElement)(s.SearchIconOutlined,null),onChange:e=>{g((t=>({...t,filter:{...t.filter,searchTerm:e.target.value}})))},allowClear:!0})))}},82615:(e,t,n)=>{n.d(t,{A:()=>u});var a=n(51609),r=n(86087),o=n(27723),i=n(75063),l=n(16784),s=n(65981),c=n(59320),p=n(51837),d=n(61328),m=n(75093);function u(e){const{groupList:t,isLoading:n}=e,[u,g]=(0,r.useState)([]),[v,f]=(0,r.useState)([]),{groupsData:h}=(0,r.useContext)(s.SpeakersGroupContext),_={selectedRowKeys:v,onChange:e=>{f(e)}};return(0,r.useEffect)((()=>{(()=>{let e=t;h?.filter?.searchTerm&&(e=e?.filter((e=>e?.name?.toLowerCase()?.includes(h?.filter?.searchTerm?.toLowerCase())))),g(e)})()}),[t,h]),n?(0,a.createElement)(d.f,{className:"eventin-page-wrapper"},(0,a.createElement)(i.A,{active:!0})):(0,a.createElement)(d.f,{className:"eventin-page-wrapper"},(0,a.createElement)("div",{className:"event-list-wrapper"},(0,a.createElement)(c.A,{selectedGroups:v,setSelectedGroups:f,groupList:t}),(0,a.createElement)(l.A,{className:"eventin-data-table",columns:p.A,dataSource:u,rowSelection:_,rowKey:e=>e.id,scroll:{x:560},sticky:{offsetHeader:80},showSorterTooltip:!1,pagination:{showTotal:(e,t)=>(0,a.createElement)(m.CustomShowTotal,{totalCount:e,range:t,listText:(0,o.__)("groups","eventin")})}})))}},84601:(e,t,n)=>{n.d(t,{A:()=>i});var a=n(51609),r=n(86087),o=n(65981);function i(e){const{text:t,record:n}=e,{setGroupsData:i}=(0,r.useContext)(o.SpeakersGroupContext);return(0,a.createElement)("p",{style:{cursor:"pointer",color:"#020617",fontSize:"18px",margin:0,fontWeight:600},onClick:()=>{i((e=>({...e,editData:n,isModalOpen:!0})))}},t)}},61328:(e,t,n)=>{n.d(t,{f:()=>r});var a=n(69815);const r=a.default.div`
	background-color: #f4f6fa;
	padding: 12px 32px;
	min-height: 100vh;

	.ant-table-wrapper {
		padding: 20px;
		background-color: #fff;
	}

	.ant-table-wrapper {
		border-radius: 0 0 4px 4px;
	}

	.ant-table-thead {
		> tr {
			> th {
				background-color: transparent;
				padding-top: 10px;
				font-weight: 500;
				color: #747474;
				&:before {
					display: none;
				}
			}
			th.ant-table-column-sort {
				background-color: transparent;
			}
		}
	}
	.ant-table-wrapper td.ant-table-column-sort {
		background-color: transparent;
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
			border-color: #c9c9c9;
			color: #c9c9c9;
			background-color: #fff;
		}
	}

	.title {
		color: #020617;
		font-size: 18px;
		font-weight: 600;
		line-height: 26px;
		display: inline-flex;
		margin-bottom: 6px;
	}
`;a.default.div`
	padding: 18px 24px;
	background: #fff;
	border-radius: 4px 4px 0 0;
	border-bottom: 1px solid #ddd;

	.event-filter-by-name {
		height: 36px;
		border: 1px solid #ddd;
		max-width: 220px;

		input.ant-input {
			min-height: auto;
		}
	}
`},65981:(e,t,n)=>{n.r(t),n.d(t,{SpeakersGroupContext:()=>m,default:()=>g});var a=n(51609),r=n(29491),o=n(47143),i=n(86087),l=n(27723),s=n(57770),c=n(96031),p=n(82615),d=n(23985);const m=(0,i.createContext)(),u=(0,o.withSelect)((e=>{const t=e("eventin/global");return{groupList:t.getSpeakerCategories(),isLoading:t.isResolving("getSpeakerCategories")}})),g=(0,r.compose)(u)((function(e){const{groupList:t,isLoading:n}=e;let r=(0,s.A)(t,"name");const[o,u]=(0,i.useState)({filter:{group:null,searchTerm:null},editData:{},isModalOpen:!1}),g=e=>{u((t=>({...t,isModalOpen:e})))};return(0,a.createElement)(m.Provider,{value:{groupsData:o,setGroupsData:u}},(0,a.createElement)("div",{className:"event-tags-wrapper"},(0,a.createElement)(c.A,{title:(0,l.__)("Speakers Group","eventin"),onClickCallback:()=>g(!0),buttonText:(0,l.__)("New Group","eventin")}),(0,a.createElement)(p.A,{isLoading:n,groupList:r}),(0,a.createElement)(d.A,{modalOpen:o.isModalOpen,setModalOpen:g})))}))},23985:(e,t,n)=>{n.d(t,{A:()=>v});var a=n(51609),r=n(29491),o=n(47143),i=n(86087),l=n(52619),s=n(27723),c=n(60742),p=n(500),d=n(10012),m=n(64282),u=n(65981);const g=(0,o.withDispatch)((e=>{const t=e("eventin/global");return{refreshCategoryList:()=>t.invalidateResolution("getSpeakerCategories")}})),v=(0,r.compose)(g)((e=>{const{modalOpen:t,setModalOpen:n,refreshCategoryList:r,...o}=e,[g]=c.A.useForm(),[v,f]=(0,i.useState)(!1),{groupsData:h,setGroupsData:_}=(0,i.useContext)(u.SpeakersGroupContext)||{},x=h?.editData?.id;return(0,i.useEffect)((()=>{if(t){if(x){const{name:e}=h?.editData;g.setFieldsValue({name:e})}}else g.resetFields(),_&&_((e=>({...e,editData:{}})))}),[t]),(0,a.createElement)(p.A,{title:(0,s.__)(x?"Edit Group":"New Group","eventin"),open:t,onCancel:()=>n(!1),cancelText:(0,s.__)("Cancel","eventin"),okText:(0,s.__)(x?" Update Group":"Add Group","eventin"),onOk:async()=>{f(!0);try{await g.validateFields();const e=g.getFieldsValue(!0);if(x){const t=h?.editData?.id;await m.A.speakerCategories.updateCategory(t,e),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully updated the group!","eventin")})}else await m.A.speakerCategories.createCategory(e),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully created group!","eventin")});r(),n(!1),g.resetFields()}catch(e){(0,l.doAction)("eventin_notification",{type:"error",message:(0,s.__)(`Couldn't ${x?"Update":"Create"} Speaker Group`,"eventin"),description:`Reason: ${e?.response?.message}`}),console.error(e)}finally{f(!1)}},confirmLoading:v,destroyOnClose:!0},(0,a.createElement)(c.A,{layout:"vertical",form:g},(0,a.createElement)("div",null,(0,a.createElement)(d.ks,{name:"name",placeholder:"Enter Group Name",label:(0,s.__)("Group Name","eventin"),size:"middle",rules:[{required:!0,message:(0,s.__)("Group Name is Required!","eventin")}],required:!0}))))}))}}]);