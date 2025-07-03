"use strict";(self.webpackChunkwp_event_solution=self.webpackChunkwp_event_solution||[]).push([[252],{28252:(e,t,n)=>{n.r(t),n.d(t,{default:()=>C});var a=n(51609),r=n(27723),l=n(56427),i=n(29491),o=n(47143),s=n(86087),c=n(92911),m=n(47767),d=n(79664),u=n(18062),p=n(27154),g=n(47152),f=n(16370),v=n(84976),E=n(7638),b=n(57237),x=n(69815);const h=x.default.li`
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
`,w=({text:e})=>(0,a.createElement)(h,null,e),A=x.default.div`
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
`,y=x.default.div`
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
			background-color: ${p.PRIMARY_COLOR};
			color: #fff;
			border-color: transparent;
		}

		&:focus {
			outline: none;
		}
	}
`;var _=n(54725),k=n(6836);const N=()=>{const[e,t]=(0,s.useState)(!1),n=(0,k.assetURL)("/images/events/video-cover.webp");return(0,a.createElement)(y,null,e?(0,a.createElement)("iframe",{"aria-label":"demo-video",width:"100%",height:"372.5",src:"https://www.youtube.com/embed/vt3s7-vD8KQ?autoplay=1",allow:"accelerometer; autoplay",allowFullScreen:!0}):(0,a.createElement)(a.Fragment,null,(0,a.createElement)("img",{src:n,alt:"Eventin intro video"}),(0,a.createElement)(E.Ay,{variant:E.zB,icon:(0,a.createElement)(_.PlayFilled,null),size:"large",className:"video-play-button",onClick:()=>t(!0)})))},L=()=>(0,a.createElement)(A,{className:"wrapper"},(0,a.createElement)(g.A,{className:"intro",gutter:60,align:"middle"},(0,a.createElement)(f.A,{xs:24,sm:24,md:24,lg:12},(0,a.createElement)(N,null)),(0,a.createElement)(f.A,{xs:24,sm:24,md:24,lg:12},(0,a.createElement)(c.A,{vertical:!0},(0,a.createElement)(b.A,{className:"intro-title",level:2,sx:{color:"#0C274A"}},(0,r.__)("Bring your sessions to life with interactive attendees","eventin")),(0,a.createElement)("ul",{className:"intro-list"},(0,a.createElement)(w,{text:(0,r.__)("Keep your meetings on track and boost your productivity","eventin")}),(0,a.createElement)(w,{text:(0,r.__)("Save attendees as templates & use them time & again","eventin")}),(0,a.createElement)(w,{text:(0,r.__)("Create and manage your personal attendees from here","eventin")})),(0,a.createElement)(c.A,{className:"intro-actions",justify:"start",align:"center",gap:12},(0,a.createElement)(v.Link,{to:"/attendees/create"},(0,a.createElement)(E.Ay,{variant:E.zB,className:"intro-button"},(0,r.__)("Let's Start Creating","eventin")))))))),R=(0,o.withSelect)((e=>{const t=e("eventin/global");return{totalAttendees:t.getTotalAttendees(),isLoading:t.isResolving("getTotalAttendees")}})),C=(0,i.compose)(R)((function(e){const{totalAttendees:t,isLoading:n}=e,i=(0,m.useNavigate)();return(0,s.useLayoutEffect)((()=>{!n&&t>0&&i("/attendees",{replace:!0})}),[t,n]),(0,a.createElement)(a.Fragment,null,(0,a.createElement)(l.Fill,{name:p.PRIMARY_HEADER_NAME},(0,a.createElement)(c.A,{justify:"space-between",align:"center"},(0,a.createElement)(u.A,{title:(0,r.__)("Attendees List","eventin")}),(0,a.createElement)(d.A,null))),(0,a.createElement)(L,null))}))}}]);