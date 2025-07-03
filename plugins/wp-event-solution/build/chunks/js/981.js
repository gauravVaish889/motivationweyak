"use strict";(self.webpackChunkwp_event_solution=self.webpackChunkwp_event_solution||[]).push([[981],{57770:(e,t,n)=>{n.d(t,{A:()=>r});var a=n(18537);function r(e,t){if(Array.isArray(e))return JSON.parse(JSON.stringify(e)).map((e=>(e[t]=(0,a.decodeEntities)(e[t]),e)))}},61149:(e,t,n)=>{n.d(t,{O:()=>o,f:()=>r});var a=n(69815);const r=a.default.div`
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
`},96031:(e,t,n)=>{n.d(t,{A:()=>x});var a=n(51609),r=n(56427),o=n(27723),i=n(92911),l=n(52741),s=n(11721),c=n(47767),d=n(69815),p=n(7638),u=n(79664),g=n(18062),m=n(27154),f=n(54725);const h=d.default.div`
	@media ( max-width: 360px ) {
		display: none;
		border: 1px solid red;
	}
`;function x(e){const{title:t,buttonText:n,onClickCallback:d}=e,x=(0,c.useNavigate)(),{pathname:v}=(0,c.useLocation)(),b=["/speakers"!==v&&{key:"0",label:(0,o.__)("Speaker List","eventin"),icon:(0,a.createElement)(f.EventListIcon,{width:20,height:20}),onClick:()=>{x("/speakers")}},"/speakers/group"!==v&&{key:"2",label:(0,o.__)("Speaker Groups","eventin"),icon:(0,a.createElement)(f.CategoriesIcon,null),onClick:()=>{x("/speakers/group")}}];return(0,a.createElement)(r.Fill,{name:m.PRIMARY_HEADER_NAME},(0,a.createElement)(i.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(g.A,{title:t}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center"}},(0,a.createElement)(p.Ay,{variant:p.zB,htmlType:"button",onClick:d,sx:{display:"flex",alignItems:"center",fontSize:"16px",fontWeight:600,borderRadius:"6px",height:"44px"}},(0,a.createElement)(f.PlusOutlined,null),n),(0,a.createElement)(l.A,{type:"vertical",style:{height:"44px",marginInline:"12px",top:"0"}}),(0,a.createElement)(i.A,{gap:12},(0,a.createElement)(s.A,{menu:{items:b},trigger:["click"],placement:"bottomRight",overlayClassName:"action-dropdown"},(0,a.createElement)(p.Ay,{variant:p.Vt,sx:{borderColor:"#E5E5E5",color:"#8C8C8C",height:"44px",lineHeight:"1"}},(0,a.createElement)(f.MoreIconOutlined,null))),(0,a.createElement)(h,null,(0,a.createElement)(u.A,null))))))}},1806:(e,t,n)=>{n.d(t,{A:()=>m});var a=n(51609),r=n(19549),o=n(29491),i=n(47143),l=n(52619),s=n(27723),c=n(54725),d=n(7638),p=n(64282);const{confirm:u}=r.A,g=(0,i.withDispatch)((e=>{const t=e("eventin/global");return{refreshGroupList:()=>t.invalidateResolution("getSpeakerCategories")}})),m=(0,o.compose)(g)((function(e){const{refreshGroupList:t,record:n}=e;return(0,a.createElement)(d.Ay,{variant:d.Vt,onClick:()=>{u({title:(0,s.__)("Are you sure?","eventin"),icon:(0,a.createElement)(c.DeleteOutlinedEmpty,null),content:(0,s.__)("Are you sure you want to delete this group?","eventin"),okText:(0,s.__)("Delete","eventin"),okButtonProps:{type:"primary",danger:!0,classNames:"delete-btn"},centered:!0,onOk:async()=>{try{await p.A.speakerCategories.deleteCategory(n.id),t(),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully deleted the group!","eventin")})}catch(e){console.error("Error deleting group!",e),(0,l.doAction)("eventin_notification",{type:"error",message:(0,s.__)("Failed to delete the group!","eventin")})}},onCancel(){console.log("Cancel")}})}},(0,a.createElement)(c.DeleteOutlined,{width:"16",height:"16"}))}))},43647:(e,t,n)=>{n.d(t,{A:()=>s});var a=n(51609),r=n(86087),o=n(54725),i=n(7638),l=n(65981);function s(e){const{record:t}=e,{setGroupsData:n}=(0,r.useContext)(l.SpeakersGroupContext);return(0,a.createElement)(i.Ay,{variant:i.Vt,onClick:()=>{n((e=>({...e,editData:t,isModalOpen:!0})))}},(0,a.createElement)(o.EditOutlined,{width:"16",height:"16"}))}},54711:(e,t,n)=>{n.d(t,{A:()=>l});var a=n(51609),r=n(90070),o=n(1806),i=n(43647);function l(e){const{record:t}=e;return(0,a.createElement)(r.A,{size:"small",className:"event-actions"},(0,a.createElement)(i.A,{record:t}),(0,a.createElement)(o.A,{record:t}))}},51837:(e,t,n)=>{n.d(t,{A:()=>l});var a=n(51609),r=n(27723),o=n(54711),i=n(84601);window.innerWidth;const l=[{title:(0,r.__)("ID","eventin"),dataIndex:"id",key:"id",defaultSortOrder:"ascend",sorter:(e,t)=>e.id-t.id},{title:(0,r.__)("Group","eventin"),dataIndex:"name",key:"name",width:"30%",render:(e,t)=>(0,a.createElement)(i.A,{text:e,record:t})},{title:(0,r.__)("Count","eventin"),dataIndex:"count",key:"count",render:e=>(0,a.createElement)("span",{className:"author"},e)},{title:(0,r.__)("Action","eventin"),key:"action",width:120,render:(e,t)=>(0,a.createElement)(o.A,{record:t})}]},59320:(e,t,n)=>{n.d(t,{A:()=>m});var a=n(51609),r=n(92911),o=n(79888),i=n(86087),l=n(27723),s=n(54725),c=n(79351),d=n(62215),p=n(61149),u=n(64282),g=n(65981);const m=e=>{const{selectedGroups:t,setSelectedGroups:n}=e,{setGroupsData:m}=(0,i.useContext)(g.SpeakersGroupContext),f=!!t?.length;return(0,a.createElement)(p.O,{className:"filter-wrapper"},(0,a.createElement)(r.A,{justify:f?"space-between":"flex-end",align:"center"},(0,a.createElement)(r.A,{justify:"start",align:"center",gap:8},f&&(0,a.createElement)(c.A,{refreshListName:"getSpeakerCategories",selectedCount:t?.length,callbackFunction:async()=>{const e=(0,d.A)(t);await u.A.speakerCategories.deleteCategory(e),n([])},setSelectedRows:n})),!f&&(0,a.createElement)(o.A,{className:"event-filter-by-name",placeholder:(0,l.__)("Search by group name","eventin"),size:"default",prefix:(0,a.createElement)(s.SearchIconOutlined,null),onChange:e=>{m((t=>({...t,filter:{...t.filter,searchTerm:e.target.value}})))},allowClear:!0})))}},82615:(e,t,n)=>{n.d(t,{A:()=>g});var a=n(51609),r=n(86087),o=n(27723),i=n(75063),l=n(16784),s=n(65981),c=n(59320),d=n(51837),p=n(61328),u=n(75093);function g(e){const{groupList:t,isLoading:n}=e,[g,m]=(0,r.useState)([]),[f,h]=(0,r.useState)([]),{groupsData:x}=(0,r.useContext)(s.SpeakersGroupContext),v={selectedRowKeys:f,onChange:e=>{h(e)}};return(0,r.useEffect)((()=>{(()=>{let e=t;x?.filter?.searchTerm&&(e=e?.filter((e=>e?.name?.toLowerCase()?.includes(x?.filter?.searchTerm?.toLowerCase())))),m(e)})()}),[t,x]),n?(0,a.createElement)(p.f,{className:"eventin-page-wrapper"},(0,a.createElement)(i.A,{active:!0})):(0,a.createElement)(p.f,{className:"eventin-page-wrapper"},(0,a.createElement)("div",{className:"event-list-wrapper"},(0,a.createElement)(c.A,{selectedGroups:f,setSelectedGroups:h,groupList:t}),(0,a.createElement)(l.A,{className:"eventin-data-table",columns:d.A,dataSource:g,rowSelection:v,rowKey:e=>e.id,scroll:{x:560},sticky:{offsetHeader:80},showSorterTooltip:!1,pagination:{showTotal:(e,t)=>(0,a.createElement)(u.CustomShowTotal,{totalCount:e,range:t,listText:(0,o.__)("groups","eventin")})}})))}},84601:(e,t,n)=>{n.d(t,{A:()=>i});var a=n(51609),r=n(86087),o=n(65981);function i(e){const{text:t,record:n}=e,{setGroupsData:i}=(0,r.useContext)(o.SpeakersGroupContext);return(0,a.createElement)("p",{style:{cursor:"pointer",color:"#020617",fontSize:"18px",margin:0,fontWeight:600},onClick:()=>{i((e=>({...e,editData:n,isModalOpen:!0})))}},t)}},61328:(e,t,n)=>{n.d(t,{f:()=>r});var a=n(69815);const r=a.default.div`
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
`},65981:(e,t,n)=>{n.r(t),n.d(t,{SpeakersGroupContext:()=>u,default:()=>m});var a=n(51609),r=n(29491),o=n(47143),i=n(86087),l=n(27723),s=n(57770),c=n(96031),d=n(82615),p=n(23985);const u=(0,i.createContext)(),g=(0,o.withSelect)((e=>{const t=e("eventin/global");return{groupList:t.getSpeakerCategories(),isLoading:t.isResolving("getSpeakerCategories")}})),m=(0,r.compose)(g)((function(e){const{groupList:t,isLoading:n}=e;let r=(0,s.A)(t,"name");const[o,g]=(0,i.useState)({filter:{group:null,searchTerm:null},editData:{},isModalOpen:!1}),m=e=>{g((t=>({...t,isModalOpen:e})))};return(0,a.createElement)(u.Provider,{value:{groupsData:o,setGroupsData:g}},(0,a.createElement)("div",{className:"event-tags-wrapper"},(0,a.createElement)(c.A,{title:(0,l.__)("Speakers Group","eventin"),onClickCallback:()=>m(!0),buttonText:(0,l.__)("New Group","eventin")}),(0,a.createElement)(d.A,{isLoading:n,groupList:r}),(0,a.createElement)(p.A,{modalOpen:o.isModalOpen,setModalOpen:m})))}))},23985:(e,t,n)=>{n.d(t,{A:()=>f});var a=n(51609),r=n(29491),o=n(47143),i=n(86087),l=n(52619),s=n(27723),c=n(60742),d=n(500),p=n(10012),u=n(64282),g=n(65981);const m=(0,o.withDispatch)((e=>{const t=e("eventin/global");return{refreshCategoryList:()=>t.invalidateResolution("getSpeakerCategories")}})),f=(0,r.compose)(m)((e=>{const{modalOpen:t,setModalOpen:n,refreshCategoryList:r,...o}=e,[m]=c.A.useForm(),[f,h]=(0,i.useState)(!1),{groupsData:x,setGroupsData:v}=(0,i.useContext)(g.SpeakersGroupContext)||{},b=x?.editData?.id;return(0,i.useEffect)((()=>{if(t){if(b){const{name:e}=x?.editData;m.setFieldsValue({name:e})}}else m.resetFields(),v&&v((e=>({...e,editData:{}})))}),[t]),(0,a.createElement)(d.A,{title:(0,s.__)(b?"Edit Group":"New Group","eventin"),open:t,onCancel:()=>n(!1),cancelText:(0,s.__)("Cancel","eventin"),okText:(0,s.__)(b?" Update Group":"Add Group","eventin"),onOk:async()=>{h(!0);try{await m.validateFields();const e=m.getFieldsValue(!0);if(b){const t=x?.editData?.id;await u.A.speakerCategories.updateCategory(t,e),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully updated the group!","eventin")})}else await u.A.speakerCategories.createCategory(e),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully created group!","eventin")});r(),n(!1),m.resetFields()}catch(e){(0,l.doAction)("eventin_notification",{type:"error",message:(0,s.__)(`Couldn't ${b?"Update":"Create"} Speaker Group`,"eventin"),description:`Reason: ${e?.response?.message}`}),console.error(e)}finally{h(!1)}},confirmLoading:f,destroyOnClose:!0},(0,a.createElement)(c.A,{layout:"vertical",form:m},(0,a.createElement)("div",null,(0,a.createElement)(p.ks,{name:"name",placeholder:"Enter Group Name",label:(0,s.__)("Group Name","eventin"),size:"middle",rules:[{required:!0,message:(0,s.__)("Group Name is Required!","eventin")}],required:!0}))))}))}}]);