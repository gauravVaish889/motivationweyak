"use strict";(self.webpackChunkwp_event_solution=self.webpackChunkwp_event_solution||[]).push([[313],{30313:(e,t,a)=>{a.r(t),a.d(t,{default:()=>z});var n=a(51609),r=a(27723),l=a(92911),i=a(47767),o=a(56427),s=a(29491),c=a(47143),m=a(86087),p=a(79664),u=a(18062),d=a(27154),g=a(47152),f=a(16370),v=a(84976),x=a(7638),E=a(57237),b=a(69815);const h=b.default.li`
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
`,w=({text:e})=>(0,n.createElement)(h,null,e),k=b.default.div`
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
`,y=b.default.div`
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
			background-color: ${d.PRIMARY_COLOR};
			color: #fff;
			border-color: transparent;
		}

		&:focus {
			outline: none;
		}
	}
`;var _=a(54725),A=a(6836);const S=()=>{const[e,t]=(0,m.useState)(!1),a=(0,A.assetURL)("/images/events/video-cover.webp");return(0,n.createElement)(y,null,e?(0,n.createElement)("iframe",{"aria-label":"demo-video",width:"100%",height:"372.5",src:"https://www.youtube.com/embed/Naq6znx-oRg?si=9SWaa0AGZHA8YyX_?autoplay=1",allow:"accelerometer; autoplay",allowFullScreen:!0}):(0,n.createElement)(n.Fragment,null,(0,n.createElement)("img",{src:a,alt:"Eventin intro video"}),(0,n.createElement)(x.Ay,{variant:x.zB,icon:(0,n.createElement)(_.PlayFilled,null),size:"large",className:"video-play-button",onClick:()=>t(!0)})))},N=()=>(0,n.createElement)(k,{className:"wrapper"},(0,n.createElement)(g.A,{className:"intro",gutter:60,align:"middle"},(0,n.createElement)(f.A,{xs:24,sm:24,md:24,lg:12},(0,n.createElement)(S,null)),(0,n.createElement)(f.A,{xs:24,sm:24,md:24,lg:12},(0,n.createElement)(l.A,{vertical:!0},(0,n.createElement)(E.A,{className:"intro-title",level:2,sx:{color:"#0C274A"}},(0,r.__)("Bring your sessions to life with interactive speaker management","eventin")),(0,n.createElement)("ul",{className:"intro-list"},(0,n.createElement)(w,{text:(0,r.__)("Keep your meetings on track and boost your productivity","eventin")}),(0,n.createElement)(w,{text:(0,r.__)("Save speaker management as templates & use them time & again","eventin")}),(0,n.createElement)(w,{text:(0,r.__)("Create and manage your personal speaker management from here","eventin")})),(0,n.createElement)(l.A,{className:"intro-actions",justify:"start",align:"center",gap:12},(0,n.createElement)(v.Link,{to:"/speakers/create"},(0,n.createElement)(x.Ay,{variant:x.zB,className:"intro-button"},(0,r.__)("Let's Start Creating","eventin")))))))),R=(0,c.withSelect)((e=>{const t=e("eventin/global");return{totalSpeakers:t.getTotalSpeakers(),isLoading:t.isResolving("getTotalSpeakers")}})),z=(0,s.compose)(R)((function(e){const{totalSpeakers:t,isLoading:a}=e,s=(0,i.useNavigate)();return(0,m.useLayoutEffect)((()=>{!a&&t>0&&s("/speakers",{replace:!0})}),[t,a]),(0,n.createElement)(n.Fragment,null,(0,n.createElement)(o.Fill,{name:d.PRIMARY_HEADER_NAME},(0,n.createElement)(l.A,{justify:"space-between",align:"center"},(0,n.createElement)(u.A,{title:(0,r.__)("Speakers and Organizers","eventin")}),(0,n.createElement)(p.A,null))),(0,n.createElement)(N,null))}))}}]);