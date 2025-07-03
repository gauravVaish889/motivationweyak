"use strict";(self.webpackChunkwp_event_solution=self.webpackChunkwp_event_solution||[]).push([[984],{63757:(e,t,a)=>{a.d(t,{A:()=>u});var n=a(51609),r=a(1455),o=a.n(r),i=a(86087),l=a(52619),s=a(27723),c=a(7638),p=a(32099),d=a(11721),m=a(54725),g=a(48842);const u=e=>{const{type:t,arrayOfIds:a,shouldShow:r}=e||{},[u,h]=(0,i.useState)(!1),f=async(e,t,a)=>{const n=new Blob([e],{type:a}),r=URL.createObjectURL(n),o=document.createElement("a");o.href=r,o.download=t,o.click(),URL.revokeObjectURL(r)},x=async e=>{const n=`/eventin/v2/${t}/export`;try{if(h(!0),"json"===e){const r=await o()({path:n,method:"POST",data:{format:e,ids:a||[]}});await f(JSON.stringify(r,null,2),`${t}.json`,"application/json")}if("csv"===e){const r=await o()({path:n,method:"POST",data:{format:e,ids:a||[]},parse:!1}),i=await r.text();await f(i,`${t}.csv`,"text/csv")}(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Exported successfully","eventin")})}catch(e){console.error("Error exporting data",e),(0,l.doAction)("eventin_notification",{type:"error",message:e.message})}finally{h(!1)}},v=[{key:"1",label:(0,n.createElement)(g.A,{style:{padding:"10px 0"},onClick:()=>x("json")},(0,s.__)("Export JSON Format","eventin")),icon:(0,n.createElement)(m.JsonFileIcon,null)},{key:"2",label:(0,n.createElement)(g.A,{onClick:()=>x("csv")},(0,s.__)("Export CSV Format","eventin")),icon:(0,n.createElement)(m.CsvFileIcon,null)}];return(0,n.createElement)(p.A,{title:r?(0,s.__)("Upgrade to Pro","eventin"):""},(0,n.createElement)(d.A,{overlayClassName:"etn-export-actions action-dropdown",menu:{items:v},placement:"bottomRight",arrow:!0,disabled:r},(0,n.createElement)(c.Ay,{className:"etn-export-btn eventin-export-button",variant:c.Vt,loading:u,sx:{display:"flex",alignItems:"center",borderColor:"#d9d9d9",fontSize:"14px",fontWeight:400,color:"#64748B",height:"36px"}},(0,n.createElement)(m.ExportIcon,{width:20,height:20}),(0,s.__)("Export","eventin")))," ")}},84174:(e,t,a)=>{a.d(t,{A:()=>h});var n=a(51609),r=a(1455),o=a.n(r),i=a(86087),l=a(27723),s=a(52619),c=a(81029),p=a(32099),d=a(19549),m=a(7638),g=a(54725);const{Dragger:u}=c.A,h=e=>{const{type:t,paramsKey:a,shouldShow:r,revalidateList:c}=e||{},[h,f]=(0,i.useState)([]),[x,v]=(0,i.useState)(!1),[k,y]=(0,i.useState)(!1),E=()=>{y(!1)},b=`/eventin/v2/${t}/import`,w=(0,i.useCallback)((async e=>{try{v(!0);const t=await o()({path:b,method:"POST",body:e});return(0,s.doAction)("eventin_notification",{type:"success",message:(0,l.__)(` ${t?.message} `,"eventin")}),c(!0),f([]),v(!1),E(),t?.data||""}catch(e){throw v(!1),(0,s.doAction)("eventin_notification",{type:"error",message:e.message}),console.error("API Error:",e),e}}),[t]),_={name:"file",accept:".json, .csv",multiple:!1,maxCount:1,onRemove:e=>{const t=h.indexOf(e),a=h.slice();a.splice(t,1),f(a)},beforeUpload:e=>(f([e]),!1),fileList:h};return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(p.A,{title:r?(0,l.__)("Upgrade to Pro","eventin"):""},(0,n.createElement)(m.Ay,{className:"etn-import-btn eventin-import-button",variant:m.Vt,sx:{display:"flex",alignItems:"center",borderColor:"#d9d9d9",fontSize:"14px",fontWeight:400,color:"#64748B",height:"36px"},onClick:()=>y(!0),disabled:r},(0,n.createElement)(g.ImportIcon,null),(0,l.__)("Import","eventin"))),(0,n.createElement)(d.A,{title:(0,l.__)("Import file","eventin"),open:k,onCancel:E,maskClosable:!1,footer:null,centered:!0,destroyOnClose:!0,wrapClassName:"etn-import-modal-wrap",className:"etn-import-modal-container eventin-import-modal-container"},(0,n.createElement)("div",{className:"etn-import-file eventin-import-file-container",style:{marginTop:"25px"}},(0,n.createElement)(u,{..._},(0,n.createElement)("p",{className:"ant-upload-drag-icon"},(0,n.createElement)(g.UploadCloudIcon,{width:"50",height:"50"})),(0,n.createElement)("p",{className:"ant-upload-text"},(0,l.__)("Click or drag file to this area to upload","eventin")),(0,n.createElement)("p",{className:"ant-upload-hint"},(0,l.__)("Choose a JSON or CSV file to import","eventin")),0!=h.length&&(0,n.createElement)(m.Ay,{onClick:async e=>{e.preventDefault(),e.stopPropagation();const t=new FormData;t.append(a,h[0],h[0].name),await w(t)},disabled:0===h.length,loading:x,variant:m.zB,className:"eventin-start-import-button"},x?(0,l.__)("Importing","eventin"):(0,l.__)("Start Import","eventin"))))))}},61149:(e,t,a)=>{a.d(t,{O:()=>o,f:()=>r});var n=a(69815);const r=n.default.div`
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
`,o=n.default.div`
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
`},55984:(e,t,a)=>{a.r(t),a.d(t,{default:()=>te});var n=a(51609),r=a(47767),o=a(29491),i=a(47143),l=a(86087),s=a(27723),c=a(96031),p=a(75063),d=a(16784),m=a(6836),g=a(92911),u=a(36492),h=a(79888),f=a(54725),x=a(79351),v=a(62215),k=a(61149),y=a(64282),E=a(63757),b=a(84174);const w=(0,i.withSelect)((e=>{const t=e("eventin/global");return{speakerGroup:t.getSpeakerCategories(),isLoading:t.isResolving("getSpeakerCategories")}})),_=(0,i.withDispatch)((e=>({shouldRefetchSpeakerList:e("eventin/global").setRevalidateSpeakerList}))),S=(0,o.compose)(w,_)((e=>{const{selectedSpeakers:t,setSelectedSpeakers:a,setParams:r,speakerGroup:o,shouldRefetchSpeakerList:i}=e,l=!!t?.length,c=o?.map((e=>({label:e.name,value:e.id}))),p=[{label:(0,s.__)("Speaker","eventin"),value:"speaker"},{label:(0,s.__)("Organizer","eventin"),value:"organizer"}];return(0,n.createElement)(k.O,{className:"filter-wrapper"},(0,n.createElement)(g.A,{justify:"space-between",align:"center",wrap:"wrap",gap:10},(0,n.createElement)(g.A,{justify:"start",align:"center",gap:8,wrap:"wrap"},l?(0,n.createElement)(x.A,{selectedCount:t?.length,callbackFunction:async()=>{const e=(0,v.A)(t);await y.A.speakers.deleteSpeaker(e),i(!0),a([])},setSelectedRows:a}):(0,n.createElement)(n.Fragment,null,(0,n.createElement)(u.A,{placeholder:(0,s.__)("Filter by Group","eventin"),options:c,size:"default",style:{minWidth:"200px",width:"100%"},onChange:e=>{r((t=>({...t,speaker_group:e})))},allowClear:!0,showSearch:!0,filterOption:(e,t)=>t?.label?.toLowerCase().includes(e?.toLowerCase())}),(0,n.createElement)(u.A,{placeholder:(0,s.__)("Filter by Role","eventin"),options:p,size:"default",style:{minWidth:"200px",width:"100%"},onChange:e=>{r((t=>({...t,category:e})))},allowClear:!0,showSearch:!0}))),!l&&(0,n.createElement)(g.A,{justify:"end",gap:8},(0,n.createElement)(h.A,{className:"event-filter-by-name",placeholder:(0,s.__)("Search by name","eventin"),size:"default",prefix:(0,n.createElement)(f.SearchIconOutlined,null),onChange:e=>{r((t=>({...t,search:e.target.value||void 0})))},allowClear:!0}),(0,n.createElement)(E.A,{type:"speakers"}),(0,n.createElement)(b.A,{type:"speakers",paramsKey:"speaker_import",revalidateList:i})),l&&(0,n.createElement)(g.A,{justify:"end",gap:8},(0,n.createElement)(E.A,{type:"speakers",arrayOfIds:t}))))}));var A=a(18537),C=a(90070),N=a(19549),I=a(52619),L=a(7638);const{confirm:R}=N.A,O=(0,i.withDispatch)((e=>({shouldRefetchSpeakerList:e("eventin/global").setRevalidateSpeakerList}))),z=(0,o.compose)(O)((function(e){const{shouldRefetchSpeakerList:t,record:a}=e;return(0,n.createElement)(L.Ib,{variant:L.Vt,onClick:()=>{R({title:(0,s.__)("Are you sure?","eventin"),icon:(0,n.createElement)(f.DeleteOutlinedEmpty,null),content:(0,s.__)("Are you sure you want to delete this speaker?","eventin"),okText:(0,s.__)("Delete","eventin"),okButtonProps:{type:"primary",danger:!0,classNames:"delete-btn"},centered:!0,onOk:async()=>{try{await y.A.speakers.deleteSpeaker(a.id),t(!0),(0,I.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully deleted the speaker!","eventin")})}catch(e){console.error("Error deleting category",e),(0,I.doAction)("eventin_notification",{type:"error",message:(0,s.__)("Failed to delete the speaker!","eventin")})}},onCancel(){}})}})}));function F(e){const{record:t}=e,a=(0,r.useNavigate)();return(0,n.createElement)(L.vQ,{variant:L.Vt,onClick:()=>{a(`/speakers/edit/${t.id}`)}})}var j=a(36877),T=a(46784),P=a(500),D=a(57237),$=a(48842),U=a(27154),V=a(69815);const W=V.default.div`
	padding: 20px;
	@media ( min-width: 767px ) {
		padding: 40px;
	}
	.etn-speaker-view-wrapper {
		display: flex;
		flex-direction: column;
		gap: 20px;
		@media ( min-width: 767px ) {
			flex-direction: row;
		}
	}

	.etn-speaker-header {
		display: flex;
		align-items: center;
		gap: 10px;
		margin-bottom: 10px;
		flex-wrap: wrap;
	}
	.etn-speaker-content {
		display: flex;
		flex-direction: column;
		gap: 10px;
	}
	.etn-speaker-social {
		display: flex;
		gap: 10px;
		align-items: center;
		margin-top: 10px;
	}
`,B=V.default.div`
	width: 30px;
	height: 30px;
	display: flex;
	justify-content: center;
	align-items: center;
	border: 1px solid #ccc;
	border-radius: 5px;
	cursor: pointer;
`,G=e=>{const{modalOpen:t,setModalOpen:a,recordData:o}=e,{id:i,name:l,category:s,designation:c,summary:p,email:d,social:m,image:g}=o,u=(0,r.useNavigate)(),h=e=>{const t=U.socialIcons.find((t=>t.iconClass===e));return t?.icon||null};return(0,n.createElement)(P.A,{open:t,onCancel:()=>a(!1),header:!1,footer:!1,width:680,destroyOnClose:!0},(0,n.createElement)(W,null,(0,n.createElement)("div",{className:"etn-speaker-view-wrapper"},g?(0,n.createElement)("img",{style:{width:150,height:150,objectFit:"cover",border:"1px solid #f0f0f0",borderRadius:"8px"},src:g,alt:"speaker-image"}):(0,n.createElement)(j.A,{shape:"square",size:150}),(0,n.createElement)("div",{className:"etn-speaker-details"},(0,n.createElement)("div",{className:"etn-speaker-header"},(0,n.createElement)(D.A,{level:3,style:{fontSize:20,margin:0}},l),s&&s.map(((e,t)=>(0,n.createElement)($.A,{style:{fontSize:12,color:"#1890FF",backgroundColor:"#1890FF1A",padding:"5px 8px",borderRadius:"20px"},key:t},e))),(0,n.createElement)(L.Ay,{variant:L.qy,onClick:()=>u(`/speakers/edit/${i}`),style:{color:"#1890FF",fontWeight:"bold",padding:"4px 10px"}},(0,n.createElement)(f.EditOutlined,{width:"16",height:"16"}))),(0,n.createElement)("div",{className:"etn-speaker-content"},c&&(0,n.createElement)($.A,null,c),d&&(0,n.createElement)($.A,null,d),(0,n.createElement)("div",{className:"etn-speaker-social"},m&&m?.map(((e,t)=>(0,n.createElement)(B,{key:t,onClick:()=>window.open(e?.etn_social_url,"_blank")},(0,n.createElement)(T.g,{icon:h(e?.icon),size:"1x"})))))))),(0,n.createElement)("div",{className:"etn-speaker-bio",style:{marginTop:"20px"}},(0,n.createElement)($.A,null,p))))};function J(e){const[t,a]=(0,l.useState)(!1),{record:r}=e;return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(L.Ay,{variant:L.Vt,onClick:()=>{window.open(`${r?.author_url}`,"_blank")}},(0,n.createElement)(f.EyeOutlinedIcon,{width:"16",height:"16"})),(0,n.createElement)(G,{modalOpen:t,setModalOpen:a,recordData:r}))}function M(e){const{record:t}=e;return(0,n.createElement)(C.A,{size:"small",className:"event-actions"},(0,n.createElement)(J,{record:t}),(0,n.createElement)(F,{record:t}),(0,n.createElement)(z,{record:t}))}var K=a(84976);const H=[{title:(0,s.__)("Name","eventin"),dataIndex:"name",key:"name",width:"20%",render:(e,t)=>(0,n.createElement)(K.Link,{to:`/speakers/edit/${t.id}`,className:"event-title"},(0,A.decodeEntities)(e))},{title:(0,s.__)("Job Title","eventin"),dataIndex:"designation",key:"designation",render:e=>(0,n.createElement)("span",{className:"author"}," ",(0,A.decodeEntities)(e))},{title:(0,s.__)("Group","eventin"),dataIndex:"speaker_group",key:"speaker_group",render:e=>(0,n.createElement)("span",null,e&&e?.join(", "))},{title:(0,s.__)("Role","eventin"),dataIndex:"category",key:"category",render:e=>e?.map((e=>(0,n.createElement)("span",{className:"etn-category-group"},e)))},{title:(0,s.__)("Company","eventin"),dataIndex:"company_name",key:"company_name",render:e=>(0,n.createElement)("span",{className:"author"}," ",(0,A.decodeEntities)(e))},{title:(0,s.__)("Action","eventin"),key:"action",width:120,render:(e,t)=>(0,n.createElement)(M,{record:t})}],q=V.default.div`
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

	.etn-category-group {
		display: flex;
		gap: 10px;
		text-transform: capitalize;
	}
`;V.default.div`
	padding: 18px 24px;
	background: #fff;
	border-radius: 4px 4px 0 0;
	border-bottom: 1px solid #ddd;

	.ant-form-item {
		margin-bottom: 0;
	}

	.event-filter-by-name {
		height: 36px;
		border: 1px solid #ddd;
		max-width: 220px;

		input.ant-input {
			min-height: auto;
		}
	}
`;var Q=a(75093);const X=(0,i.withDispatch)((e=>({setShouldRevalidateSpeakerList:e("eventin/global").setRevalidateSpeakerList}))),Y=(0,i.withSelect)((e=>({shouldRevalidateSpeakerList:e("eventin/global").getRevalidateSpeakerList()}))),Z=(0,o.compose)([X,Y])((function(e){const{isLoading:t,setShouldRevalidateSpeakerList:a,shouldRevalidateSpeakerList:r,total:o}=e,[i,c]=(0,l.useState)(o),[g,u]=(0,l.useState)([]),[h,f]=(0,l.useState)(!0),[x,v]=(0,l.useState)({paged:1,per_page:10}),[k,E]=(0,l.useState)([]),b={selectedRowKeys:k,onChange:e=>{E(e)}},w=async e=>{f(!0);const{paged:t,per_page:a,speaker_group:n,category:r,search:o}=e,i=await y.A.speakers.speakersList({speaker_group:n,category:r,search:o,paged:t,per_page:a}),l=i.headers.get("X-Wp-Total");c(l);const s=await i.json();u(s),f(!1),(0,m.scrollToTop)()};return(0,l.useEffect)((()=>{o&&w(x)}),[x,o]),(0,l.useEffect)((()=>{r&&(w(x),a(!1))}),[r]),t?(0,n.createElement)(q,{className:"eventin-page-wrapper"},(0,n.createElement)(p.A,{active:!0})):(0,n.createElement)(q,{className:"eventin-page-wrapper"},(0,n.createElement)("div",{className:"event-list-wrapper"},(0,n.createElement)(S,{selectedSpeakers:k,setSelectedSpeakers:E,setParams:v}),(0,n.createElement)(d.A,{className:"eventin-data-table",columns:H,dataSource:g,loading:h,rowSelection:b,rowKey:e=>e.id,scroll:{x:1e3},sticky:{offsetHeader:100},pagination:{paged:x.paged,per_page:x.per_page,total:i,showSizeChanger:!0,onShowSizeChange:(e,t)=>v((e=>({...e,per_page:t}))),showTotal:(e,t)=>(0,n.createElement)(Q.CustomShowTotal,{totalCount:e,range:t,listText:(0,s.__)("speakers","eventin")}),onChange:e=>v((t=>({...t,paged:e})))}})))})),ee=(0,i.withSelect)((e=>{const t=e("eventin/global");return{isLoading:t.isResolving("getTotalSpeakers"),totalSpeakers:t.getTotalSpeakers()}})),te=(0,o.compose)(ee)((function(e){const{isLoading:t,totalSpeakers:a}=e,o=(0,r.useNavigate)();return(0,l.useLayoutEffect)((()=>{t||0!==a||o("/speakers/empty",{replace:!0})}),[a,t]),(0,n.createElement)("div",null,(0,n.createElement)(c.A,{title:(0,s.__)("Speakers and Organizers","eventin"),buttonText:(0,s.__)("Add New","eventin"),onClickCallback:()=>o("/speakers/create")}),(0,n.createElement)(Z,{total:a}))}))},96031:(e,t,a)=>{a.d(t,{A:()=>x});var n=a(51609),r=a(56427),o=a(27723),i=a(92911),l=a(52741),s=a(11721),c=a(47767),p=a(69815),d=a(7638),m=a(79664),g=a(18062),u=a(27154),h=a(54725);const f=p.default.div`
	@media ( max-width: 360px ) {
		display: none;
		border: 1px solid red;
	}
`;function x(e){const{title:t,buttonText:a,onClickCallback:p}=e,x=(0,c.useNavigate)(),{pathname:v}=(0,c.useLocation)(),k=["/speakers"!==v&&{key:"0",label:(0,o.__)("Speaker List","eventin"),icon:(0,n.createElement)(h.EventListIcon,{width:20,height:20}),onClick:()=>{x("/speakers")}},"/speakers/group"!==v&&{key:"2",label:(0,o.__)("Speaker Groups","eventin"),icon:(0,n.createElement)(h.CategoriesIcon,null),onClick:()=>{x("/speakers/group")}}];return(0,n.createElement)(r.Fill,{name:u.PRIMARY_HEADER_NAME},(0,n.createElement)(i.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,n.createElement)(g.A,{title:t}),(0,n.createElement)("div",{style:{display:"flex",alignItems:"center"}},(0,n.createElement)(d.Ay,{variant:d.zB,htmlType:"button",onClick:p,sx:{display:"flex",alignItems:"center",fontSize:"16px",fontWeight:600,borderRadius:"6px",height:"44px"}},(0,n.createElement)(h.PlusOutlined,null),a),(0,n.createElement)(l.A,{type:"vertical",style:{height:"44px",marginInline:"12px",top:"0"}}),(0,n.createElement)(i.A,{gap:12},(0,n.createElement)(s.A,{menu:{items:k},trigger:["click"],placement:"bottomRight",overlayClassName:"action-dropdown"},(0,n.createElement)(d.Ay,{variant:d.Vt,sx:{borderColor:"#E5E5E5",color:"#8C8C8C",height:"44px",lineHeight:"1"}},(0,n.createElement)(h.MoreIconOutlined,null))),(0,n.createElement)(f,null,(0,n.createElement)(m.A,null))))))}}}]);