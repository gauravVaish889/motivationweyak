"use strict";(self.webpackChunkwp_event_solution=self.webpackChunkwp_event_solution||[]).push([[580],{51212:(e,t,n)=>{n.d(t,{f:()=>l});const l=n(69815).default.div`
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
`},13580:(e,t,n)=>{n.r(t),n.d(t,{default:()=>X});var l=n(51609),a=n(27723),o=n(56427),i=n(92911),r=n(52741),c=n(79664),d=n(18062),s=n(27154),_=n(51212),m=n(86087),p=n(7638),v=n(52619),h=n(16370),u=n(60742),S=n(31058),g=n(45446),f=n(85660),E=n(16326),b=n(47152),x=n(32099),y=n(64282),w=n(69815),A=n(54725),C=n(15371),k=n(10012);function $(e){const{value:t}=e,n=w.default.div`
		content: '';
		position: absolute;
		width: 100px;
		height: 30px;
		top: 4px;
		right: 40px;
		z-index: 1;
		background-image: linear-gradient(
			to right,
			rgba( 255, 255, 255, 0.3 ) 50%,
			rgb( 255, 255, 255 ) 75%
		);
	`;return(0,l.createElement)("div",{style:{position:"relative"}},(0,l.createElement)(k.ks,{value:t,readOnly:!0}),(0,l.createElement)(C.A,{copy:t,variant:{type:"ghost",size:"large"},sx:{position:"absolute",top:" 1px",right:" 1px",zIndex:100,height:"38px",borderRadius:"6px",width:"38px",backgroundColor:"#F0EAFC"},icon:(0,l.createElement)(A.CopyFillIcon,null)}),(0,l.createElement)(n,null))}const G=w.default.div`
	padding: 30px;
	background-color: #fdfdff;
	border-radius: 12px;
	margin: 0 auto;
`,I=w.default.div`
	background: #fff;
	border-radius: 8px;
	padding: 20px 30px;
	display: flex;
	justify-content: space-between;
	align-items: center;
	box-shadow: 0 2px 8px rgba( 0, 0, 0, 0.1 );
	gap: 20px;
	margin-bottom: 30px;
	&:last-child {
		margin-bottom: 0;
	}
	@media ( max-width: 768px ) {
		flex-direction: column;
		justify-content: flex-start;
		align-items: flex-start;
	}
`,V=w.default.div`
	flex: 1;
`,D=w.default.h3`
	font-size: 16px;
	font-weight: 600;
	margin: 0 0 4px;
	color: #333;
`,z=w.default.p`
	font-size: 14px;
	margin: 0;
	color: #666;
`,L=w.default.div`
	display: flex;
	gap: 10px;
	flex-wrap: wrap;
	margin: 20px 0;
`,O=!!window.localized_data_obj.evnetin_pro_active,F=e=>{const[t,n]=(0,m.useState)(""),[l,a]=(0,m.useState)(""),[o,i]=(0,m.useState)(!1),[r]=u.A.useForm(),{post_name:c}=e||{};return{form:r,generatedShortcode:t,getScript:l,loading:o,handleGenerate:e=>{r.validateFields().then((t=>{n(e(t))})).catch((e=>console.error("Validation failed:",e)))},handleGetScript:async()=>{try{i(!0);const e=await y.A.shortcodeScript.createShortcodeScript({post_name:c,shortcode:t}),n=e?.id?`<script src="${window?.localized_data_obj?.site_url}/eventin-external-script?id=${e?.id}"><\/script>`:"";a(n)}catch(e){console.log(e)}finally{i(!1)}}}},P=({form:e,formatShortcode:t,handleGenerate:n,handleGetScript:o,generatedShortcode:i,getScript:r,loading:c,children:d})=>(0,l.createElement)(u.A,{form:e,layout:"vertical"},(0,l.createElement)(b.A,{gutter:[20,20]},d),(0,l.createElement)(b.A,null,(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(L,null,(0,l.createElement)(u.A.Item,null,(0,l.createElement)(p.Ay,{variant:p.zB,onClick:()=>n(t)},(0,a.__)("Generate Shortcode","eventin"))),O&&(0,l.createElement)(u.A.Item,null,(0,l.createElement)(x.A,{title:i?(0,a.__)("Click to get script and it's only worked registered domain.","eventin"):(0,a.__)("Please Generate Shortcode First","eventin")},(0,l.createElement)(p.Ay,{variant:p.zB,onClick:o,disabled:!i,loading:c},(0,a.__)("Get Script","eventin"))))))),i&&(0,l.createElement)($,{value:i}),r&&(0,l.createElement)($,{value:r})),M=[{value:"events_calendar",label:(0,a.__)("Event With Calendar","eventin")}],R=[{value:"style-1",label:(0,a.__)("Style 1","eventin")},{value:"style-2",label:(0,a.__)("Style 2","eventin")}],T=[{value:"full_width",label:(0,a.__)("Full Width","eventin")},{value:"left",label:(0,a.__)("Left","eventin")},{value:"right",label:(0,a.__)("Right","eventin")}],B=[{value:"yes",label:(0,a.__)("Yes","eventin")},{value:"no",label:(0,a.__)("No","eventin")}];var j=n(36438);var N=n(29491);const W=(0,n(47143).withSelect)((e=>({scheduleList:e("eventin/global").getScheduleList()}))),Y=(0,N.compose)(W)((e=>{const{scheduleList:t}=e,{form:n,generatedShortcode:o,getScript:i,loading:r,handleGenerate:c,handleGetScript:d}=F({post_name:"schedule"}),s=t?.map((e=>({value:e.id,label:e.program_title})))||[];return(0,l.createElement)(P,{form:n,formatShortcode:e=>`[${e.schedules} order='${e.order}' ids='${e.ids||""}']`,handleGenerate:c,handleGetScript:d,generatedShortcode:o,getScript:i,loading:r},(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Schedule Style","eventin"),name:"schedules",initialValue:"schedules",tooltip:(0,a.__)("Select Schedule Style","eventin"),options:[{value:"schedules",label:"Schedule Tab"},{value:"schedules_list",label:"Schedule List"}]})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Order","eventin"),name:"order",initialValue:"DESC",placeholder:(0,a.__)("Select Order","eventin"),options:[{value:"ASC",label:"Ascending"},{value:"DESC",label:"Descending"}]})),(0,l.createElement)(h.A,{xs:24,md:24},(0,l.createElement)(f.A,{label:(0,a.__)("Select Schedule","eventin"),name:"ids",placeholder:(0,a.__)("Select Schedule","eventin"),options:s,tooltip:(0,a.__)("Select a Schedule to display","eventin")})))}));var U=n(34544);const H=[{title:(0,a.__)("Event","eventin"),description:(0,a.__)('Show "event details" in any specific location.',"eventin"),formContent:(0,l.createElement)((()=>{const{form:e,generatedShortcode:t,getScript:n,loading:o,handleGenerate:i,handleGetScript:r}=F({post_name:"event-shortcode"}),c=[{label:(0,a.__)("Show Event End Date","eventin"),name:"show_end_date"},{label:(0,a.__)("Show Recurring Child Events","eventin"),name:"show_child_event"},{label:(0,a.__)("Show Recurring Parent Events","eventin"),name:"show_parent_event"},{label:(0,a.__)("Show Event Location","eventin"),name:"show_event_location"},{label:(0,a.__)("Show Event Description","eventin"),name:"etn_desc_show"}];return(0,l.createElement)(P,{form:e,formatShortcode:e=>`[${e.event} style='${e.style}' event_cat_ids='${e.category||""}' event_tag_ids='${e.tag||""}' order='${e.order}' orderby='${e.orderby}' filter_with_status='${e.filter_with_status}' etn_event_col='${e.etn_event_col}' limit='${e.limit}' show_end_date='${e.show_end_date}' show_child_event='${e.show_child_event}' show_parent_event='${e.show_parent_event}' show_event_location='${e.show_event_location}' etn_desc_show='${e.etn_desc_show}']`,handleGenerate:i,handleGetScript:r,generatedShortcode:t,getScript:n,loading:o},(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Template","eventin"),name:"event",initialValue:"events_tab",placeholder:(0,a.__)("Select event","eventin"),options:[{value:"events",label:"Event List"},{value:"events_tab",label:"Event Tab"}],tooltip:(0,a.__)("Select the template you want to use for the shortcode.","eventin")})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Style","eventin"),name:"style",initialValue:"event-1",placeholder:(0,a.__)("Select Style","eventin"),options:[{value:"event-1",label:"Style 1"},{value:"event-2",label:"Style 2"}],tooltip:(0,a.__)("Select the style you want to use for the shortcode.","eventin")})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(u.A.Item,{label:(0,a.__)("Select Category","eventin"),name:"category",tooltip:(0,a.__)("Select the category you want to use for the shortcode.","eventin")},(0,l.createElement)(g.A,null))),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(u.A.Item,{label:(0,a.__)("Select Tag","eventin"),name:"tag",tooltip:(0,a.__)("Select the tag you want to use for the shortcode.","eventin")},(0,l.createElement)(E.A,null))),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Order","eventin"),name:"order",initialValue:"ASC",placeholder:(0,a.__)("Select Order","eventin"),tooltip:(0,a.__)("Select ascending or descending order for the shortcode.","eventin"),options:[{value:"ASC",label:"Ascending"},{value:"DESC",label:"Descending"}]})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Order By","eventin"),name:"orderby",initialValue:"ID",placeholder:(0,a.__)("Select Order By","eventin"),tooltip:(0,a.__)("Select the order by you want to use for the shortcode.","eventin"),options:[{value:"title",label:"Title"},{value:"ID",label:"ID"},{value:"post_date",label:"Post Date"},{value:"etn_start_date",label:"Event Start Date"},{value:"etn_end_date",label:"Event End Date"}]})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Filter by Status","eventin"),name:"filter_with_status",initialValue:"upcoming",placeholder:(0,a.__)("Select Status","eventin"),tooltip:(0,a.__)("Filter events by status.","eventin"),options:[{value:"",label:"All"},{value:"upcoming",label:"Upcoming"},{value:"ongoing",label:"Ongoing"},{value:"expire",label:"Expired"}]})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Event Column","eventin"),name:"etn_event_col",placeholder:(0,a.__)("Select Column","eventin"),initialValue:"1",tooltip:(0,a.__)("Select the column you want to use for the shortcode.","eventin"),options:[1,2,3,4,5].map((e=>({value:e.toString(),label:`Column ${e}`})))})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(u.A.Item,{label:(0,a.__)("Post Limit","eventin"),name:"limit",initialValue:20,tooltip:(0,a.__)("Select the limit you want to use for the shortcode.","eventin")},(0,l.createElement)(S.A,{size:"large",placeholder:(0,a.__)("20","eventin"),min:1,style:{width:"100%"}}))),c.map(((e,t)=>(0,l.createElement)(h.A,{xs:24,md:12,key:t},(0,l.createElement)(f.A,{label:e.label,name:e.name,initialValue:"no",options:[{value:"yes",label:"Yes"},{value:"no",label:"No"}]})))))}),null)},{title:(0,a.__)("Events With Calendar","eventin"),description:(0,a.__)('Show "events in calendar view" in any specific location.',"eventin"),formContent:(0,l.createElement)((e=>{const{form:t,generatedShortcode:n,getScript:o,loading:i,handleGenerate:r,handleGetScript:c}=F({post_name:"event-with-calendar"}),d=[{label:(0,a.__)("Show Event Description","eventin"),name:"show_dec"},{label:(0,a.__)("Show Recurring Child Events","eventin"),name:"show_child_event"},{label:(0,a.__)("Show Recurring Parent Events","eventin"),name:"show_parent_event"}];return(0,l.createElement)(P,{form:t,formatShortcode:e=>`[${e.events_calendar} style='${e.style}' event_cat_ids=${e?.category||""} calendar_show='${e.calendar_show}' limit="${e.limit}" show_dec='${e.show_dec}' show_child_event='${e.show_child_event}' show_parent_event='${e.show_parent_event}']`,handleGenerate:r,handleGetScript:c,generatedShortcode:n,getScript:o,loading:i},(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Calendar Event","eventin"),name:"events_calendar",initialValue:"events_calendar",placeholder:(0,a.__)("Select Calendar Event","eventin"),options:M,tooltip:(0,a.__)("Select the calendar event you want to display","eventin")})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Style","eventin"),name:"style",initialValue:"style-1",placeholder:(0,a.__)("Select Style","eventin"),options:R,tooltip:(0,a.__)("Select the style you want to display","eventin")})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(u.A.Item,{label:(0,a.__)("Select Category","eventin"),name:"category",tooltip:(0,a.__)("Select the category you want to display","eventin")},(0,l.createElement)(g.A,null))),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Display Calendar","eventin"),name:"calendar_show",initialValue:"full_width",placeholder:(0,a.__)("Select calendar show","eventin"),options:T,tooltip:(0,a.__)("Select the calendar show","eventin")})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(u.A.Item,{label:(0,a.__)("Post Limit","eventin"),name:"limit",initialValue:5,tooltip:(0,a.__)("Enter the post limit","eventin")},(0,l.createElement)(S.A,{size:"large",placeholder:(0,a.__)("Post Limit","eventin"),min:1,style:{width:"100%"}}))),d.map(((e,t)=>(0,l.createElement)(h.A,{xs:24,md:12,key:t},(0,l.createElement)(f.A,{label:e.label,name:e.name,initialValue:"no",options:B})))))}),null)},{title:(0,a.__)("Speakers","eventin"),description:(0,a.__)('Add "speakers profile" to show it in any specific location.',"eventin"),formContent:(0,l.createElement)((()=>{const{form:e,generatedShortcode:t,getScript:n,loading:o,handleGenerate:i,handleGetScript:r}=F({post_name:"speakers"});return(0,l.createElement)(P,{form:e,formatShortcode:e=>`[${e.speakers} style='${e.style}' cat_id='${e.category||""}' etn_speaker_col='${e.column}' order='${e.order}' orderby='${e.orderby}' limit='${e.limit}']`,handleGenerate:i,handleGetScript:r,generatedShortcode:t,getScript:n,loading:o},(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select speakers","eventin"),name:"speakers",initialValue:"speakers",tooltip:(0,a.__)("Select Speaker Shortcode Type","eventin"),options:[{value:"speakers",label:"Speakers"}]})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Style","eventin"),name:"style",initialValue:"speaker-1",placeholder:(0,a.__)("Select Style","eventin"),tooltip:(0,a.__)("Select Speaker Style","eventin"),options:[{value:"speaker-1",label:"Style 1"},{value:"speaker-2",label:"Style 2"}]})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(u.A.Item,{label:(0,a.__)("Select Category","eventin"),name:"category",tooltip:(0,a.__)("Select Speaker Category","eventin")},(0,l.createElement)(j.A,null))),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Column","eventin"),name:"column",placeholder:(0,a.__)("Select Column","eventin"),initialValue:"1",options:[1,2,3,4].map((e=>({value:e.toString(),label:`Column ${e}`})))})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Order","eventin"),name:"order",initialValue:"DESC",placeholder:(0,a.__)("Select Order","eventin"),options:[{value:"ASC",label:"Ascending"},{value:"DESC",label:"Descending"}]})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Order By","eventin"),name:"orderby",initialValue:"ID",placeholder:(0,a.__)("Select Order By","eventin"),options:[{value:"title",label:"Title"},{value:"ID",label:"ID"},{value:"post_date",label:"Post Date"},{value:"name",label:"Name"}]})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(u.A.Item,{label:(0,a.__)("Post Limit","eventin"),name:"limit",initialValue:5,tooltip:(0,a.__)("Post Limit","eventin")},(0,l.createElement)(S.A,{size:"large",placeholder:(0,a.__)("Post Limit","eventin"),min:1,style:{width:"100%"}}))))}),null)},{title:(0,a.__)("Schedules","eventin"),description:(0,a.__)('Use "schedules" to show it in any specific location.',"eventin"),formContent:(0,l.createElement)(Y,null)},{title:(0,a.__)("Advanced Search Filter","eventin"),description:(0,a.__)('Add the "advanced search filter option" in any specific location.',"eventin"),formContent:(0,l.createElement)((()=>{const{form:e,generatedShortcode:t,getScript:n,loading:o,handleGenerate:i,handleGetScript:r}=F({post_name:"advanced-search"});return(0,l.createElement)(P,{form:e,formatShortcode:e=>`[${e.event_search_filter}]`,handleGenerate:i,handleGetScript:r,generatedShortcode:t,getScript:n,loading:o},(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Template","eventin"),name:"event_search_filter",initialValue:"event_search_filter",tooltip:(0,a.__)("Select the template you want to use for the shortcode.","eventin"),options:[{value:"event_search_filter",label:(0,a.__)("Advanced Search","eventin")}]})))}),null)},{title:(0,a.__)("Event Meta Info","eventin"),description:(0,a.__)('The "events meta info" is for showing event meta details in widgets.',"eventin"),formContent:(0,l.createElement)((()=>{const{form:e,generatedShortcode:t,getScript:n,loading:o,handleGenerate:i,handleGetScript:r}=F({post_name:"event-meta-info"});return(0,l.createElement)(P,{form:e,formatShortcode:e=>`[${e.etn_event_meta_info} event_id=${e.event}]`,handleGenerate:i,handleGetScript:r,generatedShortcode:t,getScript:n,loading:o},(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(f.A,{label:(0,a.__)("Select Event Meta Info","eventin"),name:"etn_event_meta_info",initialValue:"etn_event_meta_info",tooltip:(0,a.__)("Select the template you want to use for the shortcode.","eventin"),options:[{value:"etn_event_meta_info",label:(0,a.__)("Event Meta Info","eventin")}]})),(0,l.createElement)(h.A,{xs:24,md:12},(0,l.createElement)(u.A.Item,{label:(0,a.__)("Select Event","eventin"),name:"event",tooltip:(0,a.__)("Select the event you want to use for the shortcode.","eventin")},(0,l.createElement)(U.A,null))))}),null)}],q=(0,v.applyFilters)("eventin-pro-shortcodes",H);var J=n(75093);const K=e=>{const{topicItem:t,showModal:n,setShowModal:o}=e||{},{title:i,formContent:r}=t||{},c=w.default.div`
		max-height: 65vh;
		overflow-x: hidden;
		overflow-y: auto;
		padding: 10px;
	`;return(0,l.createElement)(J.Modal,{title:(0,a.__)(`${i} Shortcode`,"eventin"),open:n,onCancel:()=>o(!1),onClose:()=>o(!1),width:"800px",destroyOnClose:!0,centered:!0,footer:null},(0,l.createElement)(c,null,r))},Q=()=>{const[e,t]=(0,m.useState)(!1),[n,o]=(0,m.useState)(null),[i,r]=(0,m.useState)("");return(0,l.createElement)(G,null,q.map(((e,n)=>(0,l.createElement)(I,{key:n},(0,l.createElement)(V,null,(0,l.createElement)(D,null,e.title),(0,l.createElement)(z,null,e.description)),(0,l.createElement)(p.Ay,{variant:p.zB,onClick:()=>(e=>{t(!0),o(e)})(e),sx:{height:"46px"}},(0,a.__)("Generate Shortcode","eventin"))))),(0,l.createElement)(K,{topicItem:n,setShowModal:t,showModal:e,generatedShortcode:i,setGeneratedShortcode:r}))};function X(){return(0,l.createElement)(_.f,{className:"eventin-page-wrapper"},(0,l.createElement)(o.Fill,{name:s.PRIMARY_HEADER_NAME},(0,l.createElement)(i.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,l.createElement)(d.A,{title:(0,a.__)("Shortcodes","eventin")}),(0,l.createElement)("div",{style:{display:"flex",alignItems:"center",gap:"12px"}},(0,l.createElement)(r.A,{type:"vertical",style:{height:"44px",marginInline:"12px",top:"0"}}),(0,l.createElement)(c.A,null)))),(0,l.createElement)(Q,null))}}}]);