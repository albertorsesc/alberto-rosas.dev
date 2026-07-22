# Bio — Alberto Rosas

This is the source of truth for who I am and what I do, written in my own voice. Use it to update the home page, the about page, meta tags, project cards, the resume header, and anywhere else my bio appears.

---

## Voice & style — read this first

When rewriting or generating copy, match this voice. Do not drift into polished AI prose.

**Do:**
- Write short, direct sentences.
- Use concrete numbers, specific tool names, real outcomes.
- Use contractions ("I'm", "don't", "it's") where natural.
- Be opinionated where I have evidence; cite the evidence in the same sentence.
- Use occasional sentence fragments when it sounds right.
- Prefer plain verbs (built, shipped, ran, broke, fixed) over abstractions (leveraged, facilitated, orchestrated).

**Don't:**
- Don't use em-dashes as a stylistic flourish. Use them sparingly, not in every paragraph.
- Don't write parallel three-item rhythms or "not just X but Y" constructions.
- Don't close paragraphs with aphorisms or generic life lessons.
- Don't use words like "passionate", "leverage", "synergy", "robust", "cutting-edge", "transform", "empower", "ecosystem", "journey", "unlock", "elevate".
- Don't add heavy bolding inside sentences.
- Don't introduce me as anything other than what I actually am.

When in doubt, write like an engineer answering a question, not like a marketer writing a landing page.

---

## Identity — one-line variants by length

**6 words (favicon title, tab title):**
Alberto Rosas — AI Systems Engineer

**12 words (meta title, footer):**
AI & Agentic Systems Engineer building production agents that hold up under real traffic.

**One sentence (meta description, social cards):**
AI & Agentic Systems Engineer with 12+ years in software and 5+ in production AI, building LangGraph + MCP agents over hybrid retrieval — with a cybersecurity automation background that shows up in how I design for safety.

**Two sentences (longer meta, profile blurbs):**
AI & Agentic Systems Engineer based in Mexico. I build production agentic systems — LangGraph workflows, MCP tool-calling, hybrid retrieval (dense + sparse + graph), NL2SQL — for customer-facing products where being wrong has real consequences.

---

## Hero — for the home page

I build agentic systems that hold up under real traffic.

12+ years in software, 5+ in production AI. LangGraph workflows, MCP tool-calling, hybrid retrieval, NL2SQL engines. Judged on eval scores and uptime, not demos. Earlier years in cybersecurity automation (SIEM, IDS/IPS, SOAR) shape how I design for safety in everything I ship now.

Currently sole architect of an AI compliance engine over 500K+ regulatory records and the engineer behind a production NL-to-SQL platform for property management. Also running TriageOps, an AI adoption consultancy for mid-market teams.

Based in Mexico. English and Spanish native. US-timezone friendly.

---

## About — long-form bio for the about page

I'm an AI & Agentic Systems Engineer based in Mexico, with 12+ years in software engineering and 5+ years building production AI systems. I work on agentic platforms where the LLM is one component of a system that has to be reliable, evaluable, and safe — not a chatbot bolted onto a frontend.

Right now I'm sole architect of the AI Engine for Unified Compliance Framework's ControlSight platform, a multi-tenant compliance SaaS over 500K+ regulatory records. Hybrid retrieval on Qdrant (ModernBERT 768d + BM25, fused via RRF) plus Neo4j graph traversal across compliance hierarchies, LangGraph agentic chat with intent routing across six intents, CRAG-style hallucination grading, and multi-signal confidence tiering surfaced to the user. Custom RAGAS-integrated eval harness with an LLM-as-judge over PM-authored must/should criteria, code-fingerprinted reports, Langfuse traces end-to-end. Customers are compliance professionals — GRC managers, auditors, consultants — who feed the system's answers into audit documentation. A confident-wrong answer doesn't stay inside the product, which shapes every design call.

Before that I built SADIE, a production NL-to-SQL agentic platform for a property-management SaaS. LangGraph plus a custom MCP server exposing read-only database access with schema caching and FK detection. 93–97% accuracy under RAGAS with CI-gated regression. The read-only MCP boundary is enforced at the policy layer, not by trusting the model to behave.

At Incfile (now Bizee) I led the migration of the company's core platform from a legacy monolith to a service-oriented stack, set the development standards the team adopted across other initiatives, and built the AI layer on top: multi-agent system for document processing handling 1000+ daily requests, RAG over business documentation, fine-tuning experiments with Unsloth and HuggingFace Transformers. Cut manual data entry by 65%. Mentored 8 engineers along the way.

Earlier in my career I was Engineering Manager at Global Cybersec, where I designed an event-driven architecture processing millions of daily security events and integrated SIEM, IDS/IPS, firewalls, and SOAR platforms into a single automated response pipeline (60% reduction in incident response time, team of 5). That work — and the years of security automation it required — is why I treat agent safety, MCP attack surfaces, and policy-as-code as default concerns instead of nice-to-haves.

I also co-founded TriageOps, an AI adoption consultancy for mid-market companies. We use a 6-step methodology that starts with a Discovery Sprint; one operations team recovered 70+ hours/month (about $42K annually) from the first engagement.

---

## What I work on now

- **Production agentic systems.** LangGraph workflows, MCP tool-calling, multi-agent orchestration, long-horizon harnesses with durable plans and checkpointing.
- **Hybrid retrieval.** Dense + sparse + graph. Qdrant, Neo4j, MongoDB Atlas. RRF fusion, CRAG grading, custom rerankers.
- **NL2SQL and structured-output agents.** When the answer is a query, a row set, or a decision — not a paragraph.
- **Evaluation as engineering.** Custom domain eval harnesses, LLM-as-judge with calibrated agreement against labeled data, CI-gated regression. Most "RAG works" claims fall apart under real evals; I build the evals first.
- **Agent and MCP security.** Tool poisoning, prompt injection through tool descriptions, allowlists, content scanning, threat models attached to the design doc.
- **AI adoption for mid-market teams.** Via TriageOps. Discovery Sprints, scoped pilots, eval-gated rollouts.

---

## How I work

**Evaluation is the trust instrument.** RAGAS, golden datasets, custom domain harnesses, LLM-as-judge with measured human agreement, CI-gated regression. If it isn't measured, it isn't shipped.

**Security-first by reflex.** Years of cybersecurity automation made me allergic to systems whose guarantees are vibes. I attach a threat model to anything that calls a tool.

**Clean Architecture, async Python, Docker.** Domain → application → infrastructure, never the other way. Hexagonal layout, structured logging, observability before clever code.

**Refusal is a first-class output.** Below the relevance bar, the right answer is "I don't have sufficient sourced material for this" plus what was found. Better silence than confident-wrong.

**Decisions get written down.** Architectural calls come with the alternatives considered and the evidence, so the team can revisit them later without re-litigating from memory.

---

## Selected work — for project cards and case studies

### UCF AI Engine — Unified Compliance Framework (2025–2026)
Sole architect of the AI layer for ControlSight, a multi-tenant compliance SaaS over 500K+ regulatory records. Customers are compliance professionals using answers to map controls to regulations, draft audit-grade language, and decide whether a control covers a requirement.

Stack: Qdrant (ModernBERT 768d + BM25, RRF fusion) + Neo4j (8 entity types, 10+ relationships, Cypher cross-store validation), LangGraph chat with intent classification across six intents, CRAG grading, multi-signal confidence tiering, custom RAGAS-integrated eval harness, Langfuse v4 scoring, FastAPI, Docker, AWS. Multi-tenant subscription scoping resolved at query time with no per-tenant data duplication.

### SADIE — Storage360 (2024–2025)
Production NL-to-SQL agentic platform for a property-management SaaS.

Stack: LangGraph + custom MCP server (read-only DB access with schema caching and FK detection), MongoDB Atlas vector search, Qwen3 embeddings, structured business-rule context library, RAGAS + golden datasets + CI-gated regression (93–97% accuracy), FastAPI SSE streaming, Langfuse, Docker Compose.

### Incfile / Bizee — AI Engineer / Tech Lead (2022–present)
Led the platform migration from a legacy monolith to a service-oriented stack. Designed a multi-agent system for document processing and decision support that handles 1000+ daily requests across multiple data sources. Built the RAG pipeline over business documentation; experimented with GraphRAG/KAG for retrieval precision; ran fine-tuning experiments with Unsloth and HuggingFace Transformers. Multi-layer memory (short/long-term, procedural) for cross-session context. Cut manual data entry by 65%. Mentored 8 engineers on AI/ML practices and production deployment.

### TriageOps — co-founder
AI adoption consultancy for mid-market companies. 6-step methodology starting with a Discovery Sprint. First engagement recovered 70+ hours/month (about $42K annually) for an operations team.

### Global Cybersec — Engineering Manager (2017–2021)
Led engineering for a cybersecurity firm. Designed an event-driven architecture processing millions of daily security events for automated pattern recognition. Integrated SIEM, IDS/IPS, firewalls, and SOAR for automated threat response (60% reduction in incident response time). Built 4 microservice applications. Managed a team of 5.

### Earlier (2014–2022)
- **HQ Rental Software** — Senior Software Engineer. Built an automated email parsing pipeline that eliminated a recurring manual workflow. Initiated and built the test suite.
- **Buddhi** — Senior Software Engineer. Co-built a healthcare support platform for cancer patients and caregivers from the ground up as part of a two-person technical team.
- **Fulcrum Digital** — Full Stack Engineer. Medical SaaS for US healthcare providers; refactoring and feature delivery under test coverage requirements.
- **GT Transport** — Senior Software Engineer. Built an integrated operations platform consolidating four departments (HR, Operations, Finance, Payroll), plus a mobile app for drivers tied into the same backend.

---

## Aggregate figures

Cross-engagement numbers, for stat tiles and summary lines. Per-engagement
figures stay in "Selected work" above.

- **500K+ records across production systems** — aggregate across engagements. Confirmed by Alberto 2026-07-22.
- 500K+ regulatory records — ControlSight / UCF specifically. Corrected from 91K+ by Alberto 2026-07-22.
- 1000+ daily requests — Incfile / Bizee multi-agent system.
- Millions of daily security events — Global Cybersec event-driven architecture.

## Background

12+ years in software engineering. Path: full-stack engineer → engineering manager (cybersecurity automation) → senior software engineer (multiple industries) → AI engineer (production agentic systems). The arc reads as "kept following the work that mattered," not a clean career-track plan.

Information Technology Engineering, Universidad Politécnica de Baja California (2014–2016).

Certifications: Laravel Certified Developer (2020), The Complete LangChain & LLMs Guide, Generative AI & LLMs: Architecture and Data Preparation, Gen AI Foundational Models for NLP & Language Understanding, Business Process Modeling with AI.

---

## What I'm available for

- **Senior IC / tech-lead roles** at AI-native companies (full-time remote, contractor or EOR-employed — no US W2).
- **Selective consulting via TriageOps** for mid-market teams adopting AI. Discovery Sprints, scoped pilots, eval-gated rollouts.
- **Architecture review and second-opinion engagements** on production agentic systems — context engineering, evals, MCP, agent security.

Based in Mexico. English and Spanish native. US-timezone friendly. Available for project-based and retainer engagements.

---

## Where to find me

- **Site:** alberto-rosas.dev
- **Company:** triageops.com
- **Email:** alberto.rsesc@protonmail.com
- **LinkedIn:** linkedin.com/in/albertorsesc
- **GitHub:** github.com/albertorsesc

---

## Tagline candidates (for the hero, social cards, etc.)

Pick one or rotate:

- I build agentic systems that hold up under real traffic.
- Production agentic AI, evaluated like infrastructure.
- LangGraph + MCP + hybrid retrieval. Trust as the product.
- Agents for systems where being wrong has consequences.
- Eval-first AI engineering.

---

## Things I want surfaced on the site that probably aren't yet

These are the rare combinations on my profile. Find places to make them visible — they're the reason hiring managers and clients will reach out:

1. **The cybersecurity-to-AI background.** Most AI engineers don't have a SIEM/SOAR past. Most security engineers don't ship production LLM systems. The combination is rare and directly relevant to MCP and agent security — both of which are hot in 2026.

2. **Sole architect on production systems.** Not "contributed to" — sole architect. UCF AI Engine and SADIE both. Make sure that ownership is clear.

3. **Custom eval harnesses, not just RAGAS defaults.** I write the evals first. Surface specific metric names (trace_tree_completeness, citation_accuracy, intent_classification_accuracy) somewhere.

4. **Bilingual EN/ES native, Mexico-based, US-timezone friendly.** Useful both for US AI companies expanding LATAM go-to-market and for any forward-deployed / customer-facing engineering role.

5. **TriageOps as a consultancy.** It deserves its own surface — currently it's only a project card. Could be a dedicated section or a sibling link in the nav.

6. **Refusal as a feature, confidence tiering surfaced to users.** These are the user-facing design principles that distinguish my agents from chatbot demos. Worth featuring on the about page or as a short "principles" callout.

---

## Notes for Claude Code

- All factual claims (project names, numbers, dates, tech stack, accuracy percentages, team sizes) come from this file. Don't invent additional ones.
- If a number isn't here, don't add it. Ask first.
- Keep meta tag bios within plausible character counts: title ≤ 60, description ≤ 160.
- For the home and about page, use the longer prose. For project cards, use the case-study blocks above verbatim or compressed.
- The neon-cyan visual identity and `// The Engineer` mono-comment style is fine as a design choice; don't change those without a separate brief.
- If you generate any new copy, run it past the voice & style section at the top of this file before committing.
