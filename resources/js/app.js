import PdfWorker from 'pdfjs-dist/legacy/build/pdf.worker.min.mjs?worker';

// Each project is tested on its own screen, with bugs that belong to that kind of product.
const HUNTS = {
    store: {
        url: 'staging.example.com/checkout',
        staging: 'The store is on staging. Find what’s broken before it ships.',
        hints: ['That part is fine. Compare the edges of everything in the card.', 'Nothing wrong there. Read the words slowly, and add up the numbers.'],
        rows: [
            { id: 'title', label: 'Your order', cls: 'mock-title' },
            { id: 'align', label: 'Notebook', value: '₦6,500', cls: 'bug-align' },
            { id: 'pen', label: 'Pen', value: '₦800' },
            { id: 'typo', label: 'Delivry', value: '₦1,200', fixed: { label: 'Delivery' } },
            { id: 'total', label: 'Total', value: '₦9,500', fixed: { value: '₦8,500' }, cls: 'mock-total' },
            { id: 'overflow', label: 'Pay now', cls: 'mock-pay' },
        ],
        bugs: {
            align: { title: 'Misaligned price', report: 'The notebook price sat away from the right edge. Rows now share one alignment.' },
            typo: { title: 'Typo', report: '“Delivry” was misspelled. Corrected the label.' },
            total: { title: 'Wrong total', report: 'The items add up to ₦8,500, but it showed ₦9,500. The total now comes from the rows.' },
            overflow: { title: 'Button overflow', report: 'Pay now was wider than its card. Its width is now 100% of the content area.' },
        },
    },
    school: {
        url: 'staging.example.com/student/results',
        staging: 'The school portal is on staging, logged in as a student. Find what’s broken before it ships.',
        hints: ['That part is fine. Think about what a student should and shouldn’t see.', 'Nothing wrong there. Check the grades against the GPA.'],
        rows: [
            { id: 'title', label: 'Semester results', cls: 'mock-title' },
            { id: 'csc', label: 'CSC 101 Programming', value: 'A' },
            { id: 'mth', label: 'MTH 101 Calculus', value: 'B' },
            { id: 'typo', label: 'Enrollmnt', value: 'Confirmed', fixed: { label: 'Enrollment' } },
            { id: 'gpa', label: 'GPA', value: '5.50 / 5.00', fixed: { value: '4.50 / 5.00' }, cls: 'mock-total' },
            { id: 'admin', label: 'Edit all results', cls: 'mock-admin' },
            { id: 'overflow', label: 'Download transcript', cls: 'mock-pay' },
        ],
        bugs: {
            admin: { title: 'Admin control exposed', report: 'A student could see Edit all results. The action is now restricted to admins on the server.' },
            gpa: { title: 'Impossible GPA', report: 'An A and a B can’t give 5.50 on a 5-point scale. The calculation now gives 4.50.' },
            typo: { title: 'Typo', report: '“Enrollmnt” was misspelled. Corrected the label.' },
            overflow: { title: 'Button overflow', report: 'Download transcript was wider than its card. Its width is now 100% of the content area.' },
        },
    },
    delivery: {
        url: 'staging.example.com/orders/1042',
        staging: 'The delivery app is on staging, tracking a live order. Find what’s broken before it ships.',
        hints: ['That part is fine. Would a customer understand every value here?', 'Nothing wrong there. Add up the money, and check the time.'],
        rows: [
            { id: 'title', label: 'Order #1042', cls: 'mock-title' },
            { id: 'food', label: 'Jollof rice', value: '₦4,000' },
            { id: 'fee', label: 'Delivery fee', value: '₦1,000' },
            { id: 'total', label: 'Total', value: '₦6,000', fixed: { value: '₦5,000' }, cls: 'mock-total' },
            { id: 'rider', label: 'Rider', value: 'null', fixed: { value: 'Emeka' } },
            { id: 'eta', label: 'Arrives in', value: '-12 min', fixed: { value: '12 min' } },
            { id: 'overflow', label: 'Track rider', cls: 'mock-pay' },
        ],
        bugs: {
            rider: { title: 'Raw null on screen', report: 'The rider’s name rendered as “null” because the assignment wasn’t loaded. It now loads with the order.' },
            eta: { title: 'Negative arrival time', report: 'The countdown subtracted the times the wrong way round. It now shows 12 min.' },
            total: { title: 'Wrong total', report: 'Food and delivery add up to ₦5,000, but it charged ₦6,000. The total now comes from the rows.' },
            overflow: { title: 'Button overflow', report: 'Track rider was wider than its card. Its width is now 100% of the content area.' },
        },
    },
};

const PROJECTS = {
    delivery: {
        label: 'A delivery app',
        ask: 'I need an app for my delivery business.',
        reply: 'Good. Riders, live orders and payments are the core. How do you want to scope it?',
        tasks: [
            { name: 'Orders database', code: "Schema::create('orders', fn ($t) => $t->id());" },
            { name: 'Rider assignment', code: 'Order::pending()->each->assignNearestRider();' },
            { name: 'Live tracking', code: 'broadcast(new OrderMoved($order, $location));' },
            { name: 'Card payments', code: '$payment = Paystack::verify($reference);' },
        ],
    },
    school: {
        label: 'A school portal',
        ask: 'We need a portal for students and results.',
        reply: 'I’ve built one before. Sign-in, enrollment and results come first. How do you want to scope it?',
        tasks: [
            { name: 'Student sign-in', code: "Auth::attempt(['matric_no' => $matric, 'password' => $pin]);" },
            { name: 'Course enrollment', code: '$student->courses()->syncWithoutDetaching($ids);' },
            { name: 'Result upload', code: 'Result::upsert($rows, [\'student_id\', \'course_id\']);' },
            { name: 'Admin roles', code: "Gate::define('edit-results', fn ($u) => $u->isAdmin());" },
        ],
    },
    store: {
        label: 'An online store',
        ask: 'I want to sell my products online.',
        reply: 'Catalog, cart and checkout first. How do you want to scope it?',
        tasks: [
            { name: 'Product catalog', code: "Product::query()->where('active', true)->paginate();" },
            { name: 'Shopping cart', code: '$cart->add($product, quantity: $qty);' },
            { name: 'Checkout', code: 'DB::transaction(fn () => $cart->placeOrder());' },
            { name: 'Payment webhook', code: 'abort_unless($signature->valid(), 403);' },
        ],
    },
};

const DEALS = [
    { label: 'Everything, in two weeks', days: 14, reply: 'I won’t promise that and hand you something broken. Two weeks gets you the core, fully tested, and the rest follows in phase two.' },
    { label: 'Core features first', days: 14, reply: 'Good call. The core goes live in two weeks, then we add what real users ask for.' },
    { label: 'The full build, done properly', days: 42, reply: 'Six weeks, with a working demo every Friday so nothing surprises you.' },
];

const sleep = (ms) => new Promise((done) => setTimeout(done, ms));
const instant = () => matchMedia('(prefers-reduced-motion: reduce)').matches;

document.addEventListener('alpine:init', () => {
    window.Alpine.data('page', () => ({
        resumeStatus: '',
        resumeLoaded: false,
        hunt: HUNTS.store,
        found: [],
        hint: '',
        misses: 0,
        stages: ['Contact', 'Negotiate', 'Build', 'Test', 'Ship'],
        stage: 0,
        messages: [],
        options: [],
        project: null,
        days: 0,
        day: 1,
        taskIndex: 0,
        code: '',
        deploy: '',
        shipped: false,
        run: 0,

        get huntDone() { return this.found.length === Object.keys(this.hunt.bugs).length; },
        isFound(id) { return this.found.includes(id); },

        resetHunt() {
            this.found = [];
            this.hint = '';
            this.misses = 0;
        },

        openIdentify() {
            this.resetHunt();
            this.hunt = HUNTS.store;
            this.$flux.modal('identify').show();
        },

        guess(part) {
            if (this.isFound(part)) return;
            if (this.hunt.bugs[part]) {
                this.found.push(part);
                this.hint = '';
            } else {
                this.hint = this.hunt.hints[this.misses++ % this.hunt.hints.length];
            }
        },

        say(who, text) {
            this.messages.push({ who, text });
            this.$nextTick(() => {
                const chat = document.querySelector('.sim-chat');
                chat.scrollTop = chat.scrollHeight;
            });
        },

        openSim() {
            this.run++;
            this.resetHunt();
            Object.assign(this, { stage: 0, messages: [], project: null, days: 0, day: 1, taskIndex: 0, code: '', deploy: '', shipped: false });
            this.say('prosper', 'Hi, I’m Prosper. What are we building?');
            this.options = Object.entries(PROJECTS).map(([id, p]) => ({ label: p.label, id }));
            this.$flux.modal('simulate').show();
        },

        async choose(option) {
            const run = this.run;
            this.options = [];
            this.say('client', option.id ? PROJECTS[option.id].ask : option.label);
            await sleep(instant() ? 0 : 700);
            if (run !== this.run) return;

            if (option.id) {
                this.project = PROJECTS[option.id];
                this.hunt = HUNTS[option.id];
                this.stage = 1;
                this.say('prosper', this.project.reply);
                this.options = DEALS;
            } else if (option.days) {
                this.days = option.days;
                this.say('prosper', option.reply);
                this.options = [{ label: 'Agreed, let’s start', start: true }];
            } else if (option.start) {
                this.build(run);
            }
        },

        async build(run) {
            this.stage = 2;
            const tasks = this.project.tasks;
            for (let i = 0; i < tasks.length; i++) {
                this.taskIndex = i;
                this.code += `// ${tasks[i].name}\n`;
                for (const char of tasks[i].code) {
                    this.code += char;
                    if (!instant()) await sleep(16);
                    if (run !== this.run) return;
                }
                this.code += '\n\n';
                this.day = Math.round(((i + 1) / tasks.length) * this.days * 0.75);
                await sleep(instant() ? 0 : 300);
                if (run !== this.run) return;
            }
            this.taskIndex = tasks.length;
            await sleep(instant() ? 0 : 500);
            if (run === this.run) this.stage = 3;
        },

        async ship() {
            const run = this.run;
            this.stage = 4;
            for (const line of ['$ php artisan test', 'All tests passed', '$ npm run build', 'Assets built', '$ php artisan migrate --force', 'Database up to date', '$ deploy production', 'Live']) {
                this.deploy += `${line}\n`;
                await sleep(instant() ? 0 : 320);
                if (run !== this.run) return;
            }
            this.day = this.days;
            this.shipped = true;
        },

        // PDF.js rather than an <iframe>: phone browsers won't show a PDF inline.
        async openResume() {
            this.$flux.modal('resume').show();
            if (this.resumeLoaded) return;
            const box = document.querySelector('.resume-pages');
            this.resumeLoaded = true;
            this.resumeStatus = 'Loading resume…';
            try {
                const pdfjs = await import('pdfjs-dist/legacy/build/pdf.mjs');
                // ponytail: a bundled .js worker, because some servers send .mjs with a type browsers reject.
                pdfjs.GlobalWorkerOptions.workerPort ??= new PdfWorker();
                const pdf = await pdfjs.getDocument({ url: '/cv.pdf' }).promise;
                for (let n = 1; n <= pdf.numPages; n++) {
                    const page = await pdf.getPage(n);
                    const viewport = page.getViewport({ scale: 2 });
                    const canvas = document.createElement('canvas');
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    canvas.setAttribute('aria-label', `Resume page ${n} of ${pdf.numPages}`);
                    box.append(canvas);
                    await page.render({ canvas, viewport }).promise;
                }
                this.resumeStatus = '';
            } catch (error) {
                console.error(error);
                this.resumeLoaded = false;
                box.replaceChildren();
                this.resumeStatus = 'The resume couldn’t be displayed. Use Download PDF to open it.';
            }
        },

        // A beetle walks a wandering trail down the story as the reader scrolls.
        init() {
            const { story, trail, walker } = this.$refs;
            const draw = () => {
                const h = story.offsetHeight;
                const w = story.querySelector('.trail').clientWidth;
                let d = `M${w / 2} 0`;
                for (let y = 180, i = 0; y < h; y += 180, i++) {
                    const x = w / 2 + (i % 2 ? -1 : 1) * w * 0.3;
                    d += ` S${x} ${y - 90} ${w / 2} ${y}`;
                }
                trail.setAttribute('d', d);
                walk();
            };
            const walk = () => {
                const box = story.getBoundingClientRect();
                const done = Math.min(1, Math.max(0, (innerHeight * 0.5 - box.top) / box.height));
                const len = trail.getTotalLength();
                const a = trail.getPointAtLength(done * len);
                const b = trail.getPointAtLength(Math.min(len, done * len + 2));
                const turn = Math.atan2(b.y - a.y, b.x - a.x) * 180 / Math.PI + 90;
                walker.style.transform = `translate(${a.x}px, ${a.y}px) translate(-50%, -50%) rotate(${turn}deg)`;
            };
            draw();
            addEventListener('resize', draw, { passive: true });
            addEventListener('scroll', walk, { passive: true });
            document.fonts?.ready.then(draw);
        },
    }));
});
