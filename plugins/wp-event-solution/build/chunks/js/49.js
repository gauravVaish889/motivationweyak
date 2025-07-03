"use strict";(self.webpackChunkwp_event_solution=self.webpackChunkwp_event_solution||[]).push([[49],{63757:(e,t,n)=>{n.d(t,{A:()=>h});var a=n(51609),o=n(1455),i=n.n(o),l=n(86087),r=n(52619),c=n(27723),s=n(7638),d=n(32099),p=n(11721),m=n(54725),u=n(48842);const h=e=>{const{type:t,arrayOfIds:n,shouldShow:o}=e||{},[h,g]=(0,l.useState)(!1),f=async(e,t,n)=>{const a=new Blob([e],{type:n}),o=URL.createObjectURL(a),i=document.createElement("a");i.href=o,i.download=t,i.click(),URL.revokeObjectURL(o)},v=async e=>{const a=`/eventin/v2/${t}/export`;try{if(g(!0),"json"===e){const o=await i()({path:a,method:"POST",data:{format:e,ids:n||[]}});await f(JSON.stringify(o,null,2),`${t}.json`,"application/json")}if("csv"===e){const o=await i()({path:a,method:"POST",data:{format:e,ids:n||[]},parse:!1}),l=await o.text();await f(l,`${t}.csv`,"text/csv")}(0,r.doAction)("eventin_notification",{type:"success",message:(0,c.__)("Exported successfully","eventin")})}catch(e){console.error("Error exporting data",e),(0,r.doAction)("eventin_notification",{type:"error",message:e.message})}finally{g(!1)}},x=[{key:"1",label:(0,a.createElement)(u.A,{style:{padding:"10px 0"},onClick:()=>v("json")},(0,c.__)("Export JSON Format","eventin")),icon:(0,a.createElement)(m.JsonFileIcon,null)},{key:"2",label:(0,a.createElement)(u.A,{onClick:()=>v("csv")},(0,c.__)("Export CSV Format","eventin")),icon:(0,a.createElement)(m.CsvFileIcon,null)}];return(0,a.createElement)(d.A,{title:o?(0,c.__)("Upgrade to Pro","eventin"):""},(0,a.createElement)(p.A,{overlayClassName:"etn-export-actions action-dropdown",menu:{items:x},placement:"bottomRight",arrow:!0,disabled:o},(0,a.createElement)(s.Ay,{className:"etn-export-btn eventin-export-button",variant:s.Vt,loading:h,sx:{display:"flex",alignItems:"center",borderColor:"#d9d9d9",fontSize:"14px",fontWeight:400,color:"#64748B",height:"36px"}},(0,a.createElement)(m.ExportIcon,{width:20,height:20}),(0,c.__)("Export","eventin")))," ")}},84174:(e,t,n)=>{n.d(t,{A:()=>g});var a=n(51609),o=n(1455),i=n.n(o),l=n(86087),r=n(27723),c=n(52619),s=n(81029),d=n(32099),p=n(19549),m=n(7638),u=n(54725);const{Dragger:h}=s.A,g=e=>{const{type:t,paramsKey:n,shouldShow:o,revalidateList:s}=e||{},[g,f]=(0,l.useState)([]),[v,x]=(0,l.useState)(!1),[y,b]=(0,l.useState)(!1),_=()=>{b(!1)},w=`/eventin/v2/${t}/import`,E=(0,l.useCallback)((async e=>{try{x(!0);const t=await i()({path:w,method:"POST",body:e});return(0,c.doAction)("eventin_notification",{type:"success",message:(0,r.__)(` ${t?.message} `,"eventin")}),s(!0),f([]),x(!1),_(),t?.data||""}catch(e){throw x(!1),(0,c.doAction)("eventin_notification",{type:"error",message:e.message}),console.error("API Error:",e),e}}),[t]),S={name:"file",accept:".json, .csv",multiple:!1,maxCount:1,onRemove:e=>{const t=g.indexOf(e),n=g.slice();n.splice(t,1),f(n)},beforeUpload:e=>(f([e]),!1),fileList:g};return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(d.A,{title:o?(0,r.__)("Upgrade to Pro","eventin"):""},(0,a.createElement)(m.Ay,{className:"etn-import-btn eventin-import-button",variant:m.Vt,sx:{display:"flex",alignItems:"center",borderColor:"#d9d9d9",fontSize:"14px",fontWeight:400,color:"#64748B",height:"36px"},onClick:()=>b(!0),disabled:o},(0,a.createElement)(u.ImportIcon,null),(0,r.__)("Import","eventin"))),(0,a.createElement)(p.A,{title:(0,r.__)("Import file","eventin"),open:y,onCancel:_,maskClosable:!1,footer:null,centered:!0,destroyOnClose:!0,wrapClassName:"etn-import-modal-wrap",className:"etn-import-modal-container eventin-import-modal-container"},(0,a.createElement)("div",{className:"etn-import-file eventin-import-file-container",style:{marginTop:"25px"}},(0,a.createElement)(h,{...S},(0,a.createElement)("p",{className:"ant-upload-drag-icon"},(0,a.createElement)(u.UploadCloudIcon,{width:"50",height:"50"})),(0,a.createElement)("p",{className:"ant-upload-text"},(0,r.__)("Click or drag file to this area to upload","eventin")),(0,a.createElement)("p",{className:"ant-upload-hint"},(0,r.__)("Choose a JSON or CSV file to import","eventin")),0!=g.length&&(0,a.createElement)(m.Ay,{onClick:async e=>{e.preventDefault(),e.stopPropagation();const t=new FormData;t.append(n,g[0],g[0].name),await E(t)},disabled:0===g.length,loading:v,variant:m.zB,className:"eventin-start-import-button"},v?(0,r.__)("Importing","eventin"):(0,r.__)("Start Import","eventin"))))))}},61149:(e,t,n)=>{n.d(t,{O:()=>i,f:()=>o});var a=n(69815);const o=a.default.div`
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
`,i=a.default.div`
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
`},61049:(e,t,n)=>{n.r(t),n.d(t,{default:()=>Q});var a=n(51609),o=n(47767),i=n(27723),l=n(29491),r=n(47143),c=n(86087),s=n(75063),d=n(16784),p=n(6836),m=n(92911),u=n(79888),h=n(54725),g=n(79351),f=n(62215);n(74353);var v=n(61149),x=n(64282),y=n(63757),b=n(84174);const _=(0,r.withDispatch)((e=>({shouldRefetchScheduleList:e("eventin/global").setRevalidateScheduleList}))),w=(0,l.compose)(_)((e=>{const{selectedSchedules:t,setSelectedSchedules:n,setParams:o,shouldRefetchScheduleList:l,filteredList:r}=e,c=!!t?.length;return(0,a.createElement)(v.O,{className:"filter-wrapper"},(0,a.createElement)(m.A,{justify:"space-between",align:"center",wrap:"wrap",gap:10},(0,a.createElement)(m.A,{justify:"start",align:"center",gap:8,wrap:"wrap"},c?(0,a.createElement)(g.A,{selectedCount:t?.length,callbackFunction:async()=>{const e=(0,f.A)(t);await x.A.schedule.deleteSchedule(e),l(!0),n([])},setSelectedRows:n}):(0,a.createElement)(u.A,{className:"event-filter-by-name",placeholder:(0,i.__)("Search by program title","eventin"),size:"default",prefix:(0,a.createElement)(h.SearchIconOutlined,null),onChange:e=>{o((t=>({...t,search:e.target.value||void 0})))},allowClear:!0})),!c&&(0,a.createElement)(m.A,{justify:"end",align:"center",gap:8},(0,a.createElement)(y.A,{type:"schedules"}),(0,a.createElement)(b.A,{type:"schedules",paramsKey:"schedule_import",revalidateList:l})),c&&(0,a.createElement)(m.A,{justify:"end",align:"center",gap:8},(0,a.createElement)(y.A,{type:"schedules",arrayOfIds:t}))))}));var E=n(90070),S=n(19549),A=n(52619),k=n(7638);const{confirm:C}=S.A,R=(0,r.withDispatch)((e=>({shouldRefetchScheduleList:e("eventin/global").setRevalidateScheduleList}))),L=(0,l.compose)(R)((function(e){const{shouldRefetchScheduleList:t,record:n}=e;return(0,a.createElement)(k.Ib,{variant:k.Vt,onClick:()=>{C({title:(0,i.__)("Are you sure?","eventin"),icon:(0,a.createElement)(h.DeleteOutlinedEmpty,null),content:(0,i.__)("Are you sure you want to delete this schedule?","eventin"),okText:(0,i.__)("Delete","eventin"),okButtonProps:{type:"primary",danger:!0,classNames:"delete-btn"},centered:!0,onOk:async()=>{try{await x.A.schedule.deleteSchedule(n.id),t(!0),(0,A.doAction)("eventin_notification",{type:"success",message:(0,i.__)("Successfully deleted the schedule!","eventin")})}catch(e){console.error("Error deleting category",e),(0,A.doAction)("eventin_notification",{type:"error",message:(0,i.__)("Failed to delete the schedule!","eventin")})}},onCancel(){}})}})}));function N(e){const{record:t}=e,n=(0,o.useNavigate)();return(0,a.createElement)(k.vQ,{variant:k.Vt,onClick:()=>{n(`/schedules/edit/${t.id}`)}})}var O=n(27154);const I=(0,r.withDispatch)((e=>({shouldRefetchScheduleList:e("eventin/global").setRevalidateScheduleList}))),z=(0,l.compose)(I)((function(e){const{id:t,modalOpen:n,setModalOpen:o,shouldRefetchScheduleList:l}=e,[r,s]=(0,c.useState)(!1);return(0,a.createElement)(S.A,{centered:!0,title:(0,a.createElement)(m.A,{gap:10},(0,a.createElement)(h.DuplicateIcon,null),(0,a.createElement)("span",null,(0,i.__)("Are you sure?","eventin"))),open:n,onOk:async()=>{s(!0);try{await x.A.schedule.cloneSchedule(t),(0,A.doAction)("eventin_notification",{type:"success",message:(0,i.__)("Successfully cloned the schedule!","eventin")}),o(!1),l(!0)}catch(e){(0,A.doAction)("eventin_notification",{type:"error",message:(0,i.__)("Failed to clone the schedule!","eventin")})}finally{s(!1)}},confirmLoading:r,onCancel:()=>o(!1),okText:(0,i.__)("Clone","eventin"),okButtonProps:{type:"default",style:{height:"32px",fontWeight:600,fontSize:"14px",color:O.PRIMARY_COLOR,border:`1px solid ${O.PRIMARY_COLOR}`}},cancelButtonProps:{style:{height:"32px"}},cancelText:(0,i.__)("Cancel","eventin"),width:"344px"},(0,a.createElement)("p",null,(0,i.__)("Are you sure you want to clone this schedule?","eventin")))}));function P(e){const{record:t}=e,[n,o]=(0,c.useState)(!1);return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(k.Ay,{variant:k.Vt,onClick:()=>{o(!0)}},(0,a.createElement)(h.CloneOutlined,{width:"16",height:"16"})),(0,a.createElement)(z,{id:t.id,modalOpen:n,setModalOpen:o}))}function T(e){const{record:t}=e;return(0,a.createElement)(E.A,{size:"small",className:"event-actions"},(0,a.createElement)(P,{record:t}),(0,a.createElement)(N,{record:t}),(0,a.createElement)(L,{record:t}))}var j=n(84976);const D=[{title:(0,i.__)("Program Title","eventin"),dataIndex:"program_title",key:"program_title",width:"50%",render:(e,t)=>(0,a.createElement)(j.Link,{to:`/schedules/edit/${t.id}`,className:"event-title"},e)},{title:(0,i.__)("Date","eventin"),dataIndex:"date",key:"date",render:e=>(0,a.createElement)("span",{className:"author"},(0,p.getWordpressFormattedDate)(e))},{title:(0,i.__)("Action","eventin"),key:"action",width:120,render:(e,t)=>(0,a.createElement)(T,{record:t})}];var F=n(69815);const B=F.default.div`
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
`;F.default.div`
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
			min-height: auto;
		}
	}
`;var U=n(75093);const $=(0,r.withDispatch)((e=>({setShouldRevalidateScheduleList:e("eventin/global").setRevalidateScheduleList}))),V=(0,r.withSelect)((e=>({shouldRevalidateScheduleList:e("eventin/global").getRevalidateScheduleList()}))),M=(0,l.compose)([$,V])((function(e){const{isLoading:t,setShouldRevalidateScheduleList:n,shouldRevalidateScheduleList:l}=e,r=(0,o.useNavigate)(),[m,u]=(0,c.useState)(null),[h,g]=(0,c.useState)([]),[f,v]=(0,c.useState)(!0),[y,b]=(0,c.useState)({paged:1,per_page:10}),[_,E]=(0,c.useState)([]),S={selectedRowKeys:_,onChange:e=>{E(e)}},A=async e=>{v(!0);const{paged:t,per_page:n,year:a,search:o}=e,i=Boolean(a)||Boolean(o),l=await x.A.schedule.scheduleList({year:a,search:o,paged:t,per_page:n}),c=await l.json(),s=c?.total_items;g(c?.items),u(s),i||0!==s||r("/schedules/empty",{replace:!0}),v(!1),(0,p.scrollToTop)()};return(0,c.useEffect)((()=>{A(y)}),[y]),(0,c.useEffect)((()=>{l&&(A(y),n(!1))}),[l]),t?(0,a.createElement)(B,{className:"eventin-page-wrapper"},(0,a.createElement)(s.A,{active:!0})):(0,a.createElement)(B,{className:"eventin-page-wrapper"},(0,a.createElement)("div",{className:"event-list-wrapper"},(0,a.createElement)(w,{selectedSchedules:_,setSelectedSchedules:E,setParams:b,filteredList:h}),(0,a.createElement)(d.A,{className:"eventin-data-table",columns:D,dataSource:h,loading:f,rowSelection:S,rowKey:e=>e.id,scroll:{x:1e3},sticky:{offsetHeader:120},pagination:{paged:y.paged,per_page:y.per_page,total:m,showSizeChanger:!0,onShowSizeChange:(e,t)=>b((e=>({...e,per_page:t}))),showTotal:(e,t)=>(0,a.createElement)(U.CustomShowTotal,{totalCount:e,range:t,listText:(0,i.__)(" schedules","eventin")}),onChange:e=>b((t=>({...t,paged:e})))}})))}));var W=n(52741),J=n(56427),K=n(79664),Y=n(18062);function H(e){const{title:t,buttonText:n,onClickCallback:i}=e,{pathname:l}=((0,o.useNavigate)(),(0,o.useLocation)());return(0,a.createElement)(J.Fill,{name:O.PRIMARY_HEADER_NAME},(0,a.createElement)(m.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(Y.A,{title:t}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center"}},(0,a.createElement)(k.Ay,{variant:k.zB,htmlType:"button",onClick:i,sx:{display:"flex",alignItems:"center",fontSize:"16px",fontWeight:600,borderRadius:"6px",height:"44px"}},(0,a.createElement)(h.PlusOutlined,null),n),(0,a.createElement)(W.A,{type:"vertical",style:{height:"44px",marginInline:"12px",top:"0"}}),(0,a.createElement)(K.A,null))))}F.default.div`
	@media ( max-width: 360px ) {
		display: none;
		border: 1px solid red;
	}
`;const Q=function(e){const t=(0,o.useNavigate)();return(0,a.createElement)("div",null,(0,a.createElement)(H,{title:(0,i.__)("Schedule List","eventin"),buttonText:(0,i.__)("New Schedule","eventin"),onClickCallback:()=>t("/schedules/create")}),(0,a.createElement)(M,null))}}}]);