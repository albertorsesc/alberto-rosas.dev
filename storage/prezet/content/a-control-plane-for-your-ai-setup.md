---
title: "Governing the pile: a control plane for a personal AI setup"
slug: "a-control-plane-for-your-ai-setup"
image: /blog/img/planeops-banner.png
date: 2026-08-01
category: "AI"
excerpt: "A build log for planeops: treating a personal AI stack like the unaudited production system it is. The control-plane discipline I use to threat-model the sprawl, separate read from write, govern absence, and keep secrets unreachable by construction."
tags:
    - AI
    - AI Agents
    - Governance
    - Security
    - Control Plane
    - Reproducibility
    - Open Source
---
![An unlabeled scatter of components on the left resolves into an ordered, governed grid on the right.](planeops-sprawl.png)

We wired autonomous, capable tools into our machines faster than we learned to govern them. A coding harness that runs commands. A router holding keys to a dozen models. Local models pulled off the internet and trusted on sight. MCP servers, each one a program that executes with your privileges, wired into three clients you've forgotten about. Background jobs that fire on a schedule you didn't write down.

Every piece of that is real software with real reach. Most of us installed all of it in an afternoon and governed none of it.

I did. My laptop filled up with AI tooling I couldn't account for: what half of it was for, what depended on what, which secret it needed, or how to get any of it back if the disk died. It wasn't a mess in the cosmetic sense. It was an unaudited system with a real attack surface, running on trust I'd never checked.

So I built a small tool to watch the whole thing, and set it to run on a schedule. The first thing it did was hand me a report of what I'd lost control of. A service that should have been running, wasn't. A 70B model eating disk with nothing using it. A handful of MCP servers I'd wired up to test something once, still connected, none of them used. A secret a few tools depend on, gone. I hadn't gone looking. It surfaced all of it on its own.

*Put plainly: my personal AI stack had quietly become production, and I was running it with none of the discipline I'd demand at work.* **planeops** is what I built to change that. Not to tidy the machine. To govern it.

![planeops at a glance: the observe, drift, apply loop; the lifecycle states it enforces; the domains it governs; and the boundaries it holds by construction.](planeops-flow.png)

## You can't govern what you can't see

Governance starts with an inventory you can trust, and that's the one thing a machine that grew by accretion never has.

The loop is three verbs. `observe` scans the machine and records what's actually there, read-only, safe to run on a schedule. `drift` compares that against what you declared and reports where the two disagree. `apply` closes a gap only after it shows you the exact change and you say yes.

Declare desired state, observe actual state, close the difference on purpose, with a human in the loop.

You declare state one entry at a time, in a plain file:

```yaml
- id: ollama/llama3.2:3b
  adapter: ollama
  domain: model
  lifecycle: active
  intent: "local model, pulled and observed via the ollama adapter"
```

An id, what kind of thing it is, whether it should be there, and one line on why it exists. Write a few by hand, or let the tool seed the list from what's already installed and prune it down.

Then you run it, and it hands you the report:

```
# DRIFT
6 alert(s), 1 report, 1 uncovered.

## Alerts
- launchd/com.example.agent-gateway (active): expected present, not observed
- secrets/openrouter-api-key (active): required secret is not configured
  ...
## Report
- ollama/some-large-model:70b (parked): parked but not observed
## Uncovered
- docker/local-registry (active): awaiting the 'docker' adapter
```

Alerts are what's actually broken: a service that should be running isn't, a required secret is missing. Below that is softer drift worth a glance. At the bottom, the tool admits what it can't manage yet instead of pretending it's fine.

It does a job my other tools don't. Datadog, Prometheus, and Grafana are built to record what happened and correlate it: logs, metrics, traces, dashboards. What none of them did for my own machine was hold all that against what I meant to have and signal only the handful of things I care about. That's closer to a SIEM's job than a dashboard's, and nothing was doing it. `drift` is that layer, not more to read, just the short list of what's wrong.

Then there's the section I didn't expect to lean on as much as I do. `drift` also flags what you never declared at all: a package, a service, an MCP server observed on the machine with no entry governing it. Most of that is harmless and just wants declaring or excluding.

But if an undeclared thing is *always-on*, a service that loads at login, an agent that keeps itself alive, the tool raises it as an alert, not a note. Software that installed itself into your boot path and answers to no one is the one thing a control plane cannot stay quiet about.

The first time I ran this on my own machine, it surfaced software I'd forgotten I installed. That's when it stopped feeling like a utility.

## Everything earns its place, including what you killed

Once you can see the machine, the more useful shift is that everything on it now has to justify staying.

One field is required on every entry: `intent`, a single line saying why it exists. That sounds trivial. It's the difference between a pile you're afraid to touch and a list where every entry is a claim you can check later. "I think I installed this for something" doesn't survive contact with a required `intent` field.

You can also hand a thing its own expiry. `kill_criteria` is a plain, checkable condition for when it should go:

```yaml
- id: ollama/some-large-model:70b
  adapter: ollama
  domain: model
  lifecycle: parked
  intent: "kept on disk but no current consumer"
  kill_criteria: "no consumer for 30 days"
```

That 70B model is `parked`: on disk, nothing using it, carrying its own death warrant. Nothing sits there forever just because I forgot about it.

The part I'd defend hardest is what the tool does with the things you delete. In most setups a deletion is only an absence, and absence is trivial to undo by accident. A reboot relaunches a service. A reinstall drags back a dependency. You never notice.

The problem is persistence: the thing you decommissioned quietly comes back running, and nothing tells you. **planeops** treats "gone" as a state you declare and then enforces:

```yaml
- id: launchd/com.example.retired-gateway
  adapter: launchd
  domain: service
  lifecycle: retired
  intent: "retired; absence is desired state, recorded so a reboot cannot resurrect it"
```

If a `retired` service is ever observed running again, that's an alert. The tool doesn't just tell you what went missing; it tells you what came back that you already killed. *Absence has to be enforced, not assumed.*

I've watched a reboot resurrect something I'd retired, seen the alert fire, and killed it again on purpose. No other tool I run catches that.

## Read and write are different capabilities

![Read as an open cyan eye, write as an amber gated lock: two separate capabilities, granted separately.](planeops-read-write.png)

This is the decision I'd point to first if you asked why I keep handing the tool more of my setup. A control plane that watches your whole machine could easily become the most dangerous thing on it: it knows where everything is, it can change any of it, and it sits next to your keys.

It stays safe to grow into because it holds the smallest capability that does the job, and keeps read and write apart.

It doesn't run. Every verb starts, does one thing, and exits. No daemon, no open port, nothing resident for something else to reach or ride. Even the scheduled job is only the read path, `observe` then `drift`. There's no long-lived surface to attack.

Only one verb changes the machine. `apply` renders each change as a diff and waits for a yes before it touches anything, one step at a time. Pipe it a script with no answer and it reads silence as no.

A human stays on every irreversible step, because the failure I care about isn't "the tool did the wrong thing," it's "the tool did the right-looking thing unattended and I found out later."

Every change it does make lands on an append-only journal, written the moment it's decided, so a crash mid-apply still leaves a complete record of what ran. Nothing converges behind my back, and nothing converges without a trace.

The assistant hook is where the read/write split earns its keep. An optional MCP server lets an agent read the plane: inventory the machine, ask what drifted, see how the MCP servers are wired. It has no tool that changes your setup.

Converging drift stays behind `apply`'s confirmation, on the CLI, with a human. *An assistant can see everything and converge nothing.* That asymmetry, everything to read and nothing to change, is exactly the posture I want around an autonomous agent, and it holds because the mutation tools don't exist, not because the model was asked nicely.

## Guarantees by construction, and their limits

![A sealed vault holding a key, the secret value shown as a redacted bar: presence is visible, the value never is.](planeops-secret.png)

A secret is the one place on the machine where "usually safe" isn't good enough, so it's the one place I didn't lean on policy.

When the tool reads your machine, it holds a sealed view of your secrets. It can tell you a key exists and when it was last rotated. If any part of the code asks that handle for the actual value, the call raises, and there is deliberately no method on it to unseal.

The real value is decrypted once, at the last possible moment, by the single piece whose job is to write it into the file a consumer needs, and it never lands in a snapshot, a report, or the journal. The classic leak is a secret bleeding into a log or an agent's context window. Here it has no path, because the object that would hand the value back doesn't exist on the ordinary flow.

Here's the part I'd want a security reviewer to read. That guarantee is "no secret value by construction on the ordinary paths." It is not "unreachable by adversarial in-process code." Python can't stop code that deliberately reaches into a private attribute, and I don't pretend it can.

Sealing kills the whole class of accidental exposure, the footgun where a value slips into output nobody meant to expose. It does not turn the process into a sandbox. Knowing exactly which of those two things you've built is most of the job.

## It runs itself, and it governs itself

None of this holds if you have to remember to run it. A tool you have to remember is a tool you stop using, and an inventory you stop refreshing is worse than none: you trust it right up until you learn it went stale.

So it schedules itself. `plane schedule` writes a timer using whatever the OS already has, a `launchd` agent on macOS, a `systemd` timer on Linux, that runs the read path at login and every few hours. The result surfaces where I'll see it: `plane status --short` prints one token I keep in my shell prompt, `drift:3` when three things are off, nothing at all when the machine is clean.

One knob has a deliberate floor. Every entry can set how loud its drift should be, and one setting folds a soft signal away silently. The obvious risk with any mute button is that you quiet a noisy check, forget, and later can't tell a broken service from a calm one.

So the mute only reaches soft signals. A missing service, an absent secret, a `retired` thing that came back, anything structurally broken stays an alert no matter what you set it to. You can quiet the noise. You can't quiet a failure.

And the scheduler holds itself to the same rule. When it installs its timer, it declares that timer as another governed entry, confirmed through `apply` like everything else and watched by the same `drift`. The thing that watches your machine is watched by its own loop. There's no corner the tool exempts from its own rules, which is the property that lets me keep trusting it with more.

## This is the discipline production agents will need

Right now **planeops** keeps one machine honest. The reason I think it's worth writing about is that the shape generalizes.

Every hard part here is a problem production agent systems are about to have at scale: an inventory you can trust, capabilities split so a reader can't write, absence enforced instead of assumed, secrets unreachable by construction, a human on every irreversible step, an audit trail of every change.

We're wiring autonomous, capable models into real infrastructure. The governance layer for that, least privilege, provenance, blast-radius limits, reconcile instead of mutate, hasn't caught up to the capability. A personal machine is the smallest instance of the problem, the one where I can hold the whole thing in my head and get the discipline right before it costs more.

The keystone I'm still earning is reproduction. Drift detection is the useful part today; replay is the point. A declaration you can't rebuild from is documentation with better syntax.

There's a rehearsal that spins up a clean Linux container with the real toolchain, seeds it with a missing package, a drifted config file, and an encrypted secret, then runs the loop until the machine converges clean.

It checks the things that are easy to fake: the secret materializes into a locked-down file, a second run changes nothing, and a planted canary never appears in any snapshot, report, or log, in any form. When it passes, reproduction holds for the domains that don't care what OS they're on: packages, config, secrets.

What it doesn't cover yet is the rest. Rebuilding macOS services is a slice a Linux container can't exercise, and the full one-command "here's your whole machine back" rehearsal isn't done. It shipped at 0.1, pre-1.0 on purpose. I'd rather say that plainly than ship a reproduction claim I can't stand behind, which is the same instinct the rest of the tool is built on.

## Start by looking

So start where the tool does, with a look. Point **planeops** at your machine and run `observe`. It reads everything and changes nothing, then hands you the inventory you've been running without.

Everything else, the drift report, the confirmations, the enforced deletions, the sealed keys, is what you do once you can finally see what you're responsible for.

**planeops** is open source at [github.com/albertorsesc/planeops](https://github.com/albertorsesc/planeops). It's early, and reproduction is the part I'm still earning. But the `observe` and `drift` core runs on my machine on a schedule, and it's the reason I can tell you exactly what's on it, and exactly what can touch it.
