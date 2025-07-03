"use strict";(self.webpackChunkwp_event_solution=self.webpackChunkwp_event_solution||[]).push([[213],{50962:(e,t,n)=>{n.d(t,{A:()=>f});var a=n(51609),l=n(47152),r=n(16370),i=n(92911),o=n(84976),s=n(27723),c=n(54725),m=n(7638),d=n(57237),u=n(29721),p=n(4762),g=n(34492),v=n(27154);const f=()=>(0,a.createElement)(p.G,{className:"wrapper"},(0,a.createElement)(l.A,{className:"intro",gutter:60,align:"middle"},(0,a.createElement)(r.A,{xs:24,sm:24,md:24,lg:12},(0,a.createElement)(g.A,null)),(0,a.createElement)(r.A,{xs:24,sm:24,md:24,lg:12},(0,a.createElement)(i.A,{vertical:!0},(0,a.createElement)(d.A,{className:"intro-title",level:2},(0,s.__)("Build dynamic events & memorable experiences","eventin")),(0,a.createElement)("ul",{className:"intro-list"},(0,a.createElement)(u.A,{text:(0,s.__)("Define Speaker/Organizer roles and profiles.","eventin")}),(0,a.createElement)(u.A,{text:(0,s.__)("Set ticket tiers, pricing models, and availability.","eventin")}),(0,a.createElement)(u.A,{text:(0,s.__)("Craft a visually appealing landing page to promote your event.","eventin")}),(0,a.createElement)(u.A,{text:(0,s.__)("Configure RSVP options and manage attendee confirmation flow.","eventin")})),(0,a.createElement)(i.A,{className:"intro-actions",justify:"start",align:"center",gap:12},(0,a.createElement)(o.Link,{to:"/events/create"},(0,a.createElement)(m.Ay,{variant:m.zB,className:"intro-button"},(0,a.createElement)(c.PlusOutlined,{width:18,height:18}),(0,s.__)("Creating new event","eventin"))),(0,a.createElement)(m.Ay,{variant:m.Vt,className:"intro-button",onClick:()=>{window.open(v.DOCUMENTATION_LINK,"_blank")}},(0,s.__)("Learn more","eventin"),(0,a.createElement)(c.ExternalLinkOutlined,{width:16,height:16})))))))},79213:(e,t,n)=>{n.r(t),n.d(t,{default:()=>v});var a=n(51609),l=n(92911),r=n(47767),i=n(56427),o=n(29491),s=n(47143),c=n(86087),m=n(79664),d=n(18062),u=n(27154),p=n(50962);const g=(0,s.withSelect)((e=>{const t=e("eventin/global");return{totalEvents:t.getTotalEvents(),isLoading:t.isResolving("getTotalEvents")}})),v=(0,o.compose)(g)((function(e){const{totalEvents:t,isLoading:n}=e,o=(0,r.useNavigate)();return(0,c.useLayoutEffect)((()=>{!n&&t>0&&o("/events",{replace:!0})}),[t,n]),(0,a.createElement)(a.Fragment,null,(0,a.createElement)(i.Fill,{name:u.PRIMARY_HEADER_NAME},(0,a.createElement)(l.A,{justify:"space-between",align:"center"},(0,a.createElement)(d.A,{title:"Events"}),(0,a.createElement)(m.A,null))),(0,a.createElement)(p.A,null))}))},29721:(e,t,n)=>{n.d(t,{A:()=>i});var a=n(51609),l=n(69815);n(27723);const r=l.default.li`
	position: relative;
	padding: 0 0 0 24px;

	&::before {
		content: '';
		position: absolute;
		top: 50%;
		left: 8px;
		width: 4px;
		height: 4px;
		background-color: rgba( 0, 0, 0, 0.6 );
		border-radius: 50%;
		transform: translateY( -50% );
	}
`,i=({text:e})=>(0,a.createElement)(r,null,e)},4762:(e,t,n)=>{n.d(t,{G:()=>r,V:()=>i});var a=n(69815),l=n(27154);const r=a.default.div`
	background-color: #ffffff;
	max-width: 1224px;
	margin: 40px auto;
	padding: 0 20px;

	.intro-title {
		text-wrap: balance;
		font-weight: 600;
		font-size: 2rem;
		line-height: 38px;
		margin: 0 0 20px;
		color: #020617;
	}

	.intro-list {
		display: flex;
		flex-direction: column;
		align-items: flex-start;
		font-size: 1rem;
		gap: 8px;
		margin: 0 0 2rem;
		padding: 0;
		color: #020617;
		list-style: none;
		font-weight: 400;
	}
	.intro-button {
		display: flex;
		align-items: center;
		height: 48px;
		border-radius: 6px;
	}
`,i=a.default.div`
	margin: 0;
	position: relative;

	@media screen and ( max-width: 768px ) {
		margin: 0 0 2rem;
	}

	img {
		display: block;
		max-width: 100%;
	}

	iframe {
		border: none;
		border-radius: 10px;
	}

	.video-play-button {
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate( -50%, -50% );
		border-radius: 50%;
		background-color: rgba( 255, 255, 255, 0.2 );
		color: #fff;
		width: 60px !important;
		height: 60px;
		border-color: #f0eafc;

		&:hover {
			background-color: ${l.PRIMARY_COLOR};
			color: #fff;
			border-color: transparent;
		}

		&:focus {
			outline: none;
		}
	}
`},34492:(e,t,n)=>{n.d(t,{A:()=>c});var a=n(51609),l=n(86087),r=n(54725),i=n(7638),o=n(6836),s=n(4762);const c=()=>{const[e,t]=(0,l.useState)(!1),n=(0,o.assetURL)("/images/events/video-cover.webp");return(0,a.createElement)(s.V,null,e?(0,a.createElement)("iframe",{"aria-label":"demo-video",width:"100%",height:"372.5",src:"https://www.youtube.com/embed/dhSwZ3p02v0?si=lNY2_iFYzU0zFva0?autoplay=1",allow:"accelerometer; autoplay",allowFullScreen:!0}):(0,a.createElement)(a.Fragment,null,(0,a.createElement)("img",{src:n,alt:"Eventin intro video"}),(0,a.createElement)(i.Ay,{variant:i.zB,icon:(0,a.createElement)(r.PlayFilled,null),size:"large",className:"video-play-button",onClick:()=>t(!0)})))}}}]);